<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\Section;
use App\Services\SectionCacheService;
use Illuminate\Http\Request;

class PageSectionController extends Controller
{
    /**
     * Affiche la liste des sections d'une page.
     */
    public function index(Page $page)
    {
        $pageSections = $page->pageSections()->with('section')->orderBy('order')->get();
        $availableSections = Section::where('is_active', true)->orderBy('name')->get();
        
        return view('admin.page_sections.index', compact('page', 'pageSections', 'availableSections'));
    }

    /**
     * Affiche le formulaire d'ajout d'une section à une page.
     */
    public function create(Page $page)
    {
        $sections = Section::where('is_active', true)->orderBy('name')->get();
        
        return view('admin.page_sections.create', compact('page', 'sections'));
    }

    /**
     * Ajoute une section à une page.
     */
    public function store(Request $request, Page $page)
    {
        $validated = $request->validate([
            'section_id' => 'required|exists:sections,id',
            'custom_class' => 'nullable|string|max:255',
        ]);

        // Récupérer la section
        $section = Section::findOrFail($request->section_id);
        
        // Déterminer l'ordre le plus élevé actuel et ajouter 1
        $maxOrder = $page->pageSections()->max('order') ?? 0;
        
        // Créer la relation page-section avec les données par défaut de la section
        $pageSection = $page->pageSections()->create([
            'section_id' => $section->id,
            'section_data' => $section->default_data,
            'order' => $maxOrder + 1,
            'is_active' => true,
            'custom_class' => $validated['custom_class'] ?? null,
        ]);

        // Vider le cache de cette page
        SectionCacheService::clearPageCache($page->id);
        // Vider le cache de la page d'accueil si c'est la page d'accueil
        if ($page->is_home) {
            \Illuminate\Support\Facades\Cache::forget('home_page');
        }

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Section ajoutée à la page avec succès.');
    }

    /**
     * Affiche une section spécifique d'une page.
     */
    public function show(Page $page, PageSection $pageSection)
    {
        return view('admin.page_sections.show', compact('page', 'pageSection'));
    }

    /**
     * Affiche le formulaire d'édition d'une section d'une page.
     */
    public function edit(Page $page, PageSection $pageSection)
    {
        // Pour les sections génériques, récupérer toutes les sections disponibles
        $genericSections = null;
        
        if ($pageSection->section->blade_component === 'generic_section') {
            $genericSections = \App\Models\GenericSection::where('active', true)
                ->orderBy('title')
                ->get();
        }
        
        // Pour les sections de rapports, récupérer tous les rapports disponibles
        $reports = null;
        
        if ($pageSection->section->blade_component === 'reports') {
            $reports = \App\Models\Report::where('active', true)
                ->orderBy('title')
                ->get();
        }
        
        return view('admin.page_sections.edit', compact('page', 'pageSection', 'genericSections', 'reports'));
    }

    /**
     * Met à jour les données d'une section spécifique d'une page.
     */
    public function update(Request $request, Page $page, PageSection $pageSection)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'custom_class' => 'nullable|string|max:255',
            'section_data' => 'nullable|array',
        ]);

        // Préparer les données de section
        $sectionData = $request->input('section_data', []);
        
        // Mettre à jour la relation page-section
        $pageSection->update([
            'is_active' => $validated['is_active'] ?? true,
            'custom_class' => $validated['custom_class'],
            'section_data' => $sectionData,
        ]);

        // Vider le cache de cette page
        SectionCacheService::clearPageCache($page->id);
        // Vider le cache de la page d'accueil si c'est la page d'accueil
        if ($page->is_home) {
            \Illuminate\Support\Facades\Cache::forget('home_page');
        }

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Section mise à jour avec succès.');
    }

    /**
     * Supprime une section spécifique d'une page.
     */
    public function destroy(Page $page, PageSection $pageSection)
    {
        $pageSection->delete();

        // Vider le cache de cette page
        SectionCacheService::clearPageCache($page->id);
        // Vider le cache de la page d'accueil si c'est la page d'accueil
        if ($page->is_home) {
            \Illuminate\Support\Facades\Cache::forget('home_page');
        }

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Section supprimée de la page avec succès.');
    }

    /**
     * Met à jour l'ordre des sections.
     */
    public function updateOrder(Request $request, Page $page)
    {
        $validated = $request->validate([
            'sections' => 'required|array',
            'sections.*.id' => 'required|exists:page_sections,id',
            'sections.*.order' => 'required|integer|min:0',
        ]);

        foreach ($request->sections as $sectionData) {
            PageSection::where('id', $sectionData['id'])
                       ->where('page_id', $page->id)
                       ->update(['order' => $sectionData['order']]);
        }

        // Vider le cache de cette page
        SectionCacheService::clearPageCache($page->id);
        // Vider le cache de la page d'accueil si c'est la page d'accueil
        if ($page->is_home) {
            \Illuminate\Support\Facades\Cache::forget('home_page');
        }

        return response()->json(['success' => true]);
    }

    /**
     * Active ou désactive une section.
     */
    public function toggleActive(Request $request, Page $page, PageSection $pageSection)
    {
        $pageSection->update(['is_active' => !$pageSection->is_active]);

        // Vider le cache de cette page
        SectionCacheService::clearPageCache($page->id);
        // Vider le cache de la page d'accueil si c'est la page d'accueil
        if ($page->is_home) {
            \Illuminate\Support\Facades\Cache::forget('home_page');
        }

        return redirect()->back()
            ->with('success', 'Statut de la section mis à jour avec succès.');
    }
}
