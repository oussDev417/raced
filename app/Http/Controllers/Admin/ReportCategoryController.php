<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReportCategory;
use Illuminate\Http\Request;

class ReportCategoryController extends Controller
{
    /**
     * Affiche la liste des catégories de rapports.
     */
    public function index()
    {
        $categories = ReportCategory::orderBy('order')->get();
        return view('admin.report_categories.index', compact('categories'));
    }

    /**
     * Affiche le formulaire de création d'une catégorie de rapports.
     */
    public function create()
    {
        return view('admin.report_categories.create');
    }

    /**
     * Enregistre une nouvelle catégorie de rapports.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:report_categories,slug',
            'description' => 'nullable|string',
            'active' => 'boolean',
        ]);

        // Gestion de l'ordre
        $maxOrder = ReportCategory::max('order') ?? 0;
        $validated['order'] = $maxOrder + 1;

        ReportCategory::create($validated);

        return redirect()->route('admin.report-categories.index')
            ->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Affiche les détails d'une catégorie de rapports.
     */
    public function show(ReportCategory $category)
    {
        return view('admin.report_categories.show', compact('category'));
    }

    /**
     * Affiche le formulaire d'édition d'une catégorie de rapports.
     */
    public function edit(ReportCategory $category)
    {
        return view('admin.report_categories.edit', compact('category'));
    }

    /**
     * Met à jour une catégorie de rapports existante.
     */
    public function update(Request $request, ReportCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:report_categories,slug,' . $category->id,
            'description' => 'nullable|string',
            'active' => 'boolean',
        ]);

        $category->update($validated);

        return redirect()->route('admin.report-categories.index')
            ->with('success', 'Catégorie mise à jour avec succès.');
    }

    /**
     * Supprime une catégorie de rapports.
     */
    public function destroy(ReportCategory $category)
    {
        $category->delete();
        return redirect()->route('admin.report-categories.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }

    /**
     * Met à jour l'ordre des catégories de rapports.
     */
    public function updateOrder(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:report_categories,id',
            'items.*.order' => 'required|integer|min:0',
        ]);

        foreach ($request->items as $item) {
            ReportCategory::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Active ou désactive une catégorie de rapports.
     */
    public function toggleActive(ReportCategory $category)
    {
        $category->active = !$category->active;
        $category->save();

        return redirect()->back()
            ->with('success', 'Statut de la catégorie mis à jour avec succès.');
    }
}
