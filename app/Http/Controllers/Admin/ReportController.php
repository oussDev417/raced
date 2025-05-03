<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\ReportCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Affiche la liste des rapports.
     */
    public function index()
    {
        $reports = Report::orderBy('order')->get();
        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Affiche le formulaire de création d'un rapport.
     */
    public function create()
    {
        $categories = ReportCategory::where('active', true)->get();
        return view('admin.reports.create', compact('categories'));
    }

    /**
     * Enregistre un nouveau rapport.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'publication_date' => 'nullable|date',
            'report_category_id' => 'nullable|exists:report_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf_file' => 'nullable|mimes:pdf|max:10240',
            'active' => 'nullable|boolean',
        ]);

        // Création du rapport
        $report = Report::create($validatedData);

        // Gestion des fichiers (image et PDF)
        if ($request->hasFile('image')) {
            $report->image = $request->file('image')->store('reports/images', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            $report->pdf_file = $request->file('pdf_file')->store('reports/pdf', 'public');
        }

        $report->save();

        return redirect()->route('admin.reports.index')
            ->with('success', 'Rapport ajouté avec succès.');
    }

    /**
     * Affiche les détails d'un rapport.
     */
    public function show(Report $report)
    {
        return view('admin.reports.show', compact('report'));
    }

    /**
     * Affiche le formulaire d'édition d'un rapport.
     */
    public function edit(Report $report)
    {
        $categories = ReportCategory::where('active', true)->get();
        return view('admin.reports.edit', compact('report', 'categories'));
    }

    /**
     * Met à jour un rapport existant.
     */
    public function update(Request $request, Report $report)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'publication_date' => 'nullable|date',
            'report_category_id' => 'nullable|exists:report_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf_file' => 'nullable|mimes:pdf|max:10240',
            'active' => 'nullable|boolean',
        ]);

        // Mise à jour du rapport
        $report->update($validatedData);

        // Gestion des fichiers (image et PDF)
        if ($request->hasFile('image')) {
            $report->image = $request->file('image')->store('reports/images', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            $report->pdf_file = $request->file('pdf_file')->store('reports/pdf', 'public');
        }

        $report->save();

        return redirect()->route('admin.reports.index')
            ->with('success', 'Rapport mis à jour avec succès.');
    }

    /**
     * Supprime un rapport.
     */
    public function destroy(Report $report)
    {
        // Supprimer les fichiers associés
        if ($report->image) {
            Storage::disk('public')->delete($report->image);
        }
        if ($report->pdf_file) {
            Storage::disk('public')->delete($report->pdf_file);
        }

        $report->delete();

        return redirect()->route('admin.reports.index')
            ->with('success', 'Rapport supprimé avec succès.');
    }

    /**
     * Met à jour l'ordre des rapports.
     */
    public function updateOrder(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:reports,id',
            'items.*.order' => 'required|integer|min:0',
        ]);

        foreach ($request->items as $item) {
            Report::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Active ou désactive un rapport.
     */
    public function toggleActive(Report $report)
    {
        $report->active = !$report->active;
        $report->save();

        return redirect()->back()
            ->with('success', 'Statut du rapport mis à jour avec succès.');
    }
}
