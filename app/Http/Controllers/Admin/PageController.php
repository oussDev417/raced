<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Affiche la liste des pages.
     */
    public function index()
    {
        $pages = Page::orderBy('title')->get();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle page.
     */
    public function create()
    {
        $templates = [
            'default' => 'Template par défaut',
            'full-width' => 'Pleine largeur',
            'with-sidebar' => 'Avec barre latérale',
        ];
        
        return view('admin.pages.create', compact('templates'));
    }

    /**
     * Enregistre une nouvelle page.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'template' => 'required|string',
            'status' => 'required|in:published,draft',
            'is_home' => 'boolean',
            'show_in_menu' => 'boolean',
            'menu_order' => 'nullable|integer',
        ]);

        // Si le slug n'est pas fourni, on le génère à partir du titre
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Si cette page est définie comme page d'accueil, désactive les autres
        if ($request->has('is_home') && $request->is_home) {
            Page::where('is_home', true)->update(['is_home' => false]);
        }

        $page = Page::create($validated);

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Page créée avec succès.');
    }

    /**
     * Affiche une page spécifique.
     */
    public function show(Page $page)
    {
        return view('admin.pages.show', compact('page'));
    }

    /**
     * Affiche le formulaire d'édition d'une page.
     */
    public function edit(Page $page)
    {
        $templates = [
            'default' => 'Template par défaut',
            'full-width' => 'Pleine largeur',
            'with-sidebar' => 'Avec barre latérale',
        ];
        
        $sections = Section::where('is_active', true)->orderBy('name')->get();
        $pageSections = $page->pageSections()->with('section')->orderBy('order')->get();
        
        return view('admin.pages.edit', compact('page', 'templates', 'sections', 'pageSections'));
    }

    /**
     * Met à jour une page spécifique.
     */
    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'template' => 'required|string',
            'status' => 'required|in:published,draft',
            'is_home' => 'boolean',
            'show_in_menu' => 'boolean',
            'menu_order' => 'nullable|integer',
        ]);

        // Si cette page est définie comme page d'accueil, désactive les autres
        if ($request->has('is_home') && $request->is_home && !$page->is_home) {
            Page::where('is_home', true)->update(['is_home' => false]);
        }

        $page->update($validated);

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Page mise à jour avec succès.');
    }

    /**
     * Supprime une page spécifique.
     */
    public function destroy(Page $page)
    {
        if ($page->is_home) {
            return back()->with('error', 'Vous ne pouvez pas supprimer la page d\'accueil.');
        }

        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page supprimée avec succès.');
    }
}
