<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Affiche la liste des menus.
     */
    public function index()
    {
        $menus = Menu::with('items')->orderBy('name')->get();
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Affiche le formulaire de création d'un nouveau menu.
     */
    public function create()
    {
        $locations = [
            'header' => 'En-tête',
            'footer' => 'Pied de page',
            'sidebar' => 'Barre latérale',
            'mobile' => 'Menu mobile',
        ];
        
        return view('admin.menus.create', compact('locations'));
    }

    /**
     * Enregistre un nouveau menu.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        Menu::create($validated);

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu créé avec succès.');
    }

    /**
     * Affiche un menu spécifique.
     */
    public function show(Menu $menu)
    {
        $menu->load(['rootItems.children']);
        return view('admin.menus.show', compact('menu'));
    }

    /**
     * Affiche le formulaire d'édition d'un menu.
     */
    public function edit(Menu $menu)
    {
        $locations = [
            'header' => 'En-tête',
            'footer' => 'Pied de page',
            'sidebar' => 'Barre latérale',
            'mobile' => 'Menu mobile',
        ];
        
        return view('admin.menus.edit', compact('menu', 'locations'));
    }

    /**
     * Met à jour un menu spécifique.
     */
    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $menu->update($validated);

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu mis à jour avec succès.');
    }

    /**
     * Supprime un menu spécifique.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu supprimé avec succès.');
    }

    /**
     * Affiche l'interface d'édition du contenu d'un menu.
     */
    public function builder(Menu $menu)
    {
        $menu->load(['items']);
        
        $locations = [
            'header' => 'En-tête',
            'footer' => 'Pied de page',
            'sidebar' => 'Barre latérale',
            'mobile' => 'Menu mobile',
        ];
        
        return view('admin.menus.builder', compact('menu', 'locations'));
    }

    /**
     * Met à jour l'ordre des éléments de menu.
     */
    public function updateOrder(Request $request, Menu $menu)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:menu_items,id',
            'items.*.parent_id' => 'nullable',
            'items.*.order' => 'required|integer|min:1',
        ]);

        $items = $request->input('items');
        
        // Validation supplémentaire pour s'assurer que tous les éléments appartiennent à ce menu
        $menuItemIds = $menu->items()->pluck('id')->toArray();
        foreach ($items as $item) {
            if (!in_array($item['id'], $menuItemIds)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Un ou plusieurs éléments n\'appartiennent pas à ce menu'
                ], 400);
            }
        }
        
        // Mise à jour de l'ordre de chaque élément
        foreach ($items as $item) {
            $menuItem = \App\Models\MenuItem::find($item['id']);
            if ($menuItem) {
                $menuItem->update([
                    'parent_id' => $item['parent_id'] ?: null,
                    'order' => $item['order']
                ]);
            }
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Ordre du menu mis à jour avec succès'
        ]);
    }
}
