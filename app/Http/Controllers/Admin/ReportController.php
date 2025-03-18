<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
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
        return view('admin.reports.create');
    }

    /**
     * Enregistre un nouveau rapport.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'publication_date' => 'nullable|date',
            'image' => 'nullable|image|max:2048',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'active' => 'boolean'
        ]);

        // Gestion de l'ordre
        $maxOrder = Report::max('order') ?? 0;
        $validated['order'] = $maxOrder + 1;

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reports/images', 'public');
            $validated['image'] = $imagePath;
        }

        // Gestion du fichier PDF
        if ($request->hasFile('pdf_file')) {
            $pdfPath = $request->file('pdf_file')->store('reports/files', 'public');
            $validated['pdf_file'] = $pdfPath;
        }

        Report::create($validated);

        return redirect()->route('admin.reports.index')
            ->with('success', 'Rapport créé avec succès.');
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
        return view('admin.reports.edit', compact('report'));
    }

    /**
     * Met à jour un rapport existant.
     */
    public function update(Request $request, Report $report)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'publication_date' => 'nullable|date',
            'image' => 'nullable|image|max:2048',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'active' => 'boolean'
        ]);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($report->image) {
                Storage::disk('public')->delete($report->image);
            }
            $imagePath = $request->file('image')->store('reports/images', 'public');
            $validated['image'] = $imagePath;
        }

        // Gestion du fichier PDF
        if ($request->hasFile('pdf_file')) {
            // Supprimer l'ancien fichier PDF s'il existe
            if ($report->pdf_file) {
                Storage::disk('public')->delete($report->pdf_file);
            }
            $pdfPath = $request->file('pdf_file')->store('reports/files', 'public');
            $validated['pdf_file'] = $pdfPath;
        }

        $report->update($validated);

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
