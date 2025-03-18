<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GenericSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GenericSectionController extends Controller
{
    /**
     * Affiche la liste des sections génériques.
     */
    public function index()
    {
        $sections = GenericSection::orderBy('order')->get();
        return view('admin.generic_sections.index', compact('sections'));
    }

    /**
     * Affiche le formulaire de création d'une section générique.
     */
    public function create()
    {
        return view('admin.generic_sections.create');
    }

    /**
     * Enregistre une nouvelle section générique.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url|max:255',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'background_color' => 'nullable|string|max:50',
            'text_color' => 'nullable|string|max:50',
            'active' => 'boolean'
        ]);

        // Gestion de l'ordre
        $maxOrder = GenericSection::max('order') ?? 0;
        $validated['order'] = $maxOrder + 1;

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('sections/images', 'public');
            $validated['image'] = $imagePath;
        }

        GenericSection::create($validated);

        return redirect()->route('admin.generic_sections.index')
            ->with('success', 'Section générique créée avec succès.');
    }

    /**
     * Affiche les détails d'une section générique.
     */
    public function show(GenericSection $genericSection)
    {
        return view('admin.generic_sections.show', compact('genericSection'));
    }

    /**
     * Affiche le formulaire d'édition d'une section générique.
     */
    public function edit(GenericSection $genericSection)
    {
        return view('admin.generic_sections.edit', compact('genericSection'));
    }

    /**
     * Met à jour une section générique existante.
     */
    public function update(Request $request, GenericSection $genericSection)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url|max:255',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'background_color' => 'nullable|string|max:50',
            'text_color' => 'nullable|string|max:50',
            'active' => 'boolean'
        ]);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($genericSection->image) {
                Storage::disk('public')->delete($genericSection->image);
            }
            $imagePath = $request->file('image')->store('sections/images', 'public');
            $validated['image'] = $imagePath;
        }

        $genericSection->update($validated);

        return redirect()->route('admin.generic_sections.index')
            ->with('success', 'Section générique mise à jour avec succès.');
    }

    /**
     * Supprime une section générique.
     */
    public function destroy(GenericSection $genericSection)
    {
        // Supprimer l'image associée
        if ($genericSection->image) {
            Storage::disk('public')->delete($genericSection->image);
        }

        $genericSection->delete();

        return redirect()->route('admin.generic_sections.index')
            ->with('success', 'Section générique supprimée avec succès.');
    }

    /**
     * Met à jour l'ordre des sections génériques.
     */
    public function updateOrder(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:generic_sections,id',
            'items.*.order' => 'required|integer|min:0',
        ]);

        foreach ($request->items as $item) {
            GenericSection::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Active ou désactive une section générique.
     */
    public function toggleActive(GenericSection $genericSection)
    {
        $genericSection->active = !$genericSection->active;
        $genericSection->save();

        return redirect()->back()
            ->with('success', 'Statut de la section générique mis à jour avec succès.');
    }
}
