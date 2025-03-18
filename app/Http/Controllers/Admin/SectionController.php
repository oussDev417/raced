<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Affiche la liste des types de sections disponibles.
     */
    public function index()
    {
        $sections = Section::orderBy('name')->get();
        return view('admin.sections.index', compact('sections'));
    }

    /**
     * Affiche le formulaire de création d'un nouveau type de section.
     */
    public function create()
    {
        // Liste des composants Blade disponibles
        $bladeComponents = [
            'slider' => 'Slider',
            'about' => 'À propos',
            'feature' => 'Valeurs',
            'opportunites' => 'Opportunités',
            'project' => 'Projets',
            'stats' => 'Statistiques',
            'team' => 'Équipe',
            'testimonial' => 'Témoignages',
            'new' => 'Actualités',
            'gallery' => 'Galerie',
            'partners' => 'Partenaires',
            'benevole' => 'Bénévoles',
            'contact' => 'Contact',
            'custom_html' => 'HTML personnalisé',
        ];
        
        return view('admin.sections.create', compact('bladeComponents'));
    }

    /**
     * Enregistre un nouveau type de section.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'type' => 'required|string|max:255|unique:sections',
            'blade_component' => 'required|string|max:255',
            'description' => 'nullable|string',
            'default_data' => 'nullable|json',
            'is_active' => 'boolean',
        ]);

        // Convertir default_data en JSON si fourni
        if (!empty($validated['default_data'])) {
            $validated['default_data'] = json_decode($validated['default_data'], true);
        }

        Section::create($validated);

        return redirect()->route('admin.sections.index')
            ->with('success', 'Type de section créé avec succès.');
    }

    /**
     * Affiche un type de section spécifique.
     */
    public function show(Section $section)
    {
        return view('admin.sections.show', compact('section'));
    }

    /**
     * Affiche le formulaire d'édition d'un type de section.
     */
    public function edit(Section $section)
    {
        // Liste des composants Blade disponibles
        $bladeComponents = [
            'slider' => 'Slider',
            'about' => 'À propos',
            'feature' => 'Valeurs',
            'opportunites' => 'Opportunités',
            'project' => 'Projets',
            'stats' => 'Statistiques',
            'team' => 'Équipe',
            'testimonial' => 'Témoignages',
            'new' => 'Actualités',
            'gallery' => 'Galerie',
            'partners' => 'Partenaires',
            'benevole' => 'Bénévoles',
            'contact' => 'Contact',
            'custom_html' => 'HTML personnalisé',
        ];
        
        return view('admin.sections.edit', compact('section', 'bladeComponents'));
    }

    /**
     * Met à jour un type de section spécifique.
     */
    public function update(Request $request, Section $section)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'type' => 'required|string|max:255|unique:sections,type,' . $section->id,
            'blade_component' => 'required|string|max:255',
            'description' => 'nullable|string',
            'default_data' => 'nullable|json',
            'is_active' => 'boolean',
        ]);

        // Convertir default_data en JSON si fourni
        if (!empty($validated['default_data'])) {
            $validated['default_data'] = json_decode($validated['default_data'], true);
        }

        $section->update($validated);

        return redirect()->route('admin.sections.index')
            ->with('success', 'Type de section mis à jour avec succès.');
    }

    /**
     * Supprime un type de section spécifique.
     */
    public function destroy(Section $section)
    {
        // Vérifier si la section est utilisée dans des pages
        if ($section->pageSections()->count() > 0) {
            return back()->with('error', 'Impossible de supprimer ce type de section car il est utilisé dans une ou plusieurs pages.');
        }

        $section->delete();

        return redirect()->route('admin.sections.index')
            ->with('success', 'Type de section supprimé avec succès.');
    }

    /**
     * Active/désactive un type de section.
     */
    public function toggleActive(Section $section)
    {
        $section->update(['is_active' => !$section->is_active]);

        return redirect()->route('admin.sections.index')
            ->with('success', 'État du type de section mis à jour avec succès.');
    }
}
