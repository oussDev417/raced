<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    /**
     * Affiche la liste des éléments d'un menu.
     */
    public function index(Menu $menu)
    {
        $menuItems = $menu->items()->orderBy('order')->get();
        return view('admin.menu_items.index', compact('menu', 'menuItems'));
    }

    /**
     * Affiche le formulaire de création d'un nouvel élément de menu.
     */
    public function create(Menu $menu)
    {
        $pages = Page::where('status', 'published')->orderBy('title')->pluck('title', 'id');
        $parentItems = $menu->items()->whereNull('parent_id')->orderBy('title')->pluck('title', 'id');
        
        $targets = [
            '_self' => 'Même fenêtre',
            '_blank' => 'Nouvelle fenêtre',
        ];
        
        return view('admin.menu_items.create', compact('menu', 'pages', 'parentItems', 'targets'));
    }

    /**
     * Enregistre un nouvel élément de menu.
     */
    public function store(Request $request, Menu $menu)
    {
        // Valider les champs de base
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'page_id' => 'nullable|exists:pages,id',
            'parent_id' => 'nullable|exists:menu_items,id',
            'order' => 'nullable|integer',
            'target' => 'required|string|in:_self,_blank',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'link_type' => 'required|in:url,page',
        ]);

        // Traiter les données en fonction du type de lien
        if ($validatedData['link_type'] == 'page') {
            // Si c'est un lien vers une page, on supprime l'URL
            $validatedData['url'] = null;
            
            // Vérifier que page_id est défini
            if (empty($validatedData['page_id'])) {
                return back()
                    ->withInput()
                    ->withErrors(['page_id' => 'Vous devez sélectionner une page pour un lien interne.']);
            }
        } else {
            // Si c'est une URL personnalisée, on supprime page_id
            $validatedData['page_id'] = null;
            
            // Vérifier que l'URL est définie
            if (empty($validatedData['url'])) {
                return back()
                    ->withInput()
                    ->withErrors(['url' => 'Vous devez spécifier une URL pour un lien personnalisé.']);
            }
        }

        // Supprimer le type de lien du tableau car il n'existe pas dans la table
        unset($validatedData['link_type']);

        // Si un ordre n'est pas spécifié, on ajoute à la fin
        if (empty($validatedData['order'])) {
            $validatedData['order'] = $menu->items()->max('order') + 1;
        }

        // Créer l'élément de menu
        $menu->items()->create($validatedData);

        return redirect()->route('admin.menus.builder', $menu)
            ->with('success', 'Élément de menu créé avec succès.');
    }

    /**
     * Affiche un élément de menu spécifique.
     */
    public function show(Menu $menu, MenuItem $menuItem)
    {
        return view('admin.menu_items.show', compact('menu', 'menuItem'));
    }

    /**
     * Affiche le formulaire d'édition d'un élément de menu.
     */
    public function edit(Menu $menu, MenuItem $menuItem)
    {
        $pages = Page::where('status', 'published')->orderBy('title')->pluck('title', 'id');
        
        // Récupérer les éléments parents potentiels (exclure l'élément actuel et ses enfants)
        $parentItems = $menu->items()
            ->where('id', '!=', $menuItem->id)
            ->whereNotIn('parent_id', $menuItem->children()->pluck('id')->toArray())
            ->whereNull('parent_id')
            ->orderBy('title')
            ->pluck('title', 'id');
        
        $targets = [
            '_self' => 'Même fenêtre',
            '_blank' => 'Nouvelle fenêtre',
        ];
        
        return view('admin.menu_items.edit', compact('menu', 'menuItem', 'pages', 'parentItems', 'targets'));
    }

    /**
     * Met à jour un élément de menu spécifique.
     */
    public function update(Request $request, Menu $menu, MenuItem $menuItem)
    {
        // Valider les champs de base
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'page_id' => 'nullable|exists:pages,id',
            'parent_id' => 'nullable|exists:menu_items,id',
            'order' => 'nullable|integer',
            'target' => 'required|string|in:_self,_blank',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'link_type' => 'required|in:url,page',
        ]);

        // Traiter les données en fonction du type de lien
        if ($validatedData['link_type'] == 'page') {
            // Si c'est un lien vers une page, on supprime l'URL
            $validatedData['url'] = null;
            
            // Vérifier que page_id est défini
            if (empty($validatedData['page_id'])) {
                return back()
                    ->withInput()
                    ->withErrors(['page_id' => 'Vous devez sélectionner une page pour un lien interne.']);
            }
        } else {
            // Si c'est une URL personnalisée, on supprime page_id
            $validatedData['page_id'] = null;
            
            // Vérifier que l'URL est définie
            if (empty($validatedData['url'])) {
                return back()
                    ->withInput()
                    ->withErrors(['url' => 'Vous devez spécifier une URL pour un lien personnalisé.']);
            }
        }

        // Supprimer le type de lien du tableau car il n'existe pas dans la table
        unset($validatedData['link_type']);

        // Vérifier que l'élément parent n'est pas un enfant de cet élément
        if (!empty($validatedData['parent_id'])) {
            $childIds = $menuItem->children()->pluck('id')->toArray();
            if (in_array($validatedData['parent_id'], $childIds)) {
                return back()->withErrors(['parent_id' => 'Vous ne pouvez pas sélectionner un enfant de cet élément comme parent.']);
            }
            
            // Vérifier que l'élément parent n'est pas l'élément lui-même
            if ($validatedData['parent_id'] == $menuItem->id) {
                return back()->withErrors(['parent_id' => 'Un élément ne peut pas être son propre parent.']);
            }
        }

        // Mettre à jour l'élément de menu
        $menuItem->update($validatedData);

        return redirect()->route('admin.menus.builder', $menu)
            ->with('success', 'Élément de menu mis à jour avec succès.');
    }

    /**
     * Supprime un élément de menu spécifique.
     */
    public function destroy(Menu $menu, MenuItem $menuItem)
    {
        $menuItem->delete();

        return redirect()->route('admin.menus.builder', $menu)
            ->with('success', 'Élément de menu supprimé avec succès.');
    }

    /**
     * Met à jour l'ordre des éléments de menu.
     */
    public function updateOrder(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:menu_items,id',
            'items.*.parent_id' => 'nullable|exists:menu_items,id',
            'items.*.order' => 'required|integer|min:0',
        ]);

        foreach ($request->items as $itemData) {
            MenuItem::where('id', $itemData['id'])
                   ->where('menu_id', $menu->id)
                   ->update([
                       'parent_id' => $itemData['parent_id'] ?? null,
                       'order' => $itemData['order'],
                   ]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Active ou désactive un élément de menu.
     */
    public function toggleActive(Request $request, Menu $menu, MenuItem $menuItem)
    {
        $menuItem->update(['is_active' => !$menuItem->is_active]);

        return redirect()->route('admin.menus.builder', $menu)
            ->with('success', 'État de l\'élément de menu mis à jour avec succès.');
    }
}
