<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EquipeCategoryRequest;
use App\Models\EquipeCategory;
use Illuminate\Http\Request;

class EquipeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = EquipeCategory::withCount('equipes')->latest()->get();
        return view('admin.equipe-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.equipe-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EquipeCategoryRequest $request)
    {
        $data = $request->validated();
        
        EquipeCategory::create($data);
        
        return redirect()->route('admin.equipe-categories.index')->with('success', 'Catégorie créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EquipeCategory $equipeCategory)
    {
        return view('admin.equipe-categories.edit', compact('equipeCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EquipeCategoryRequest $request, EquipeCategory $equipeCategory)
    {
        $data = $request->validated();
        
        $equipeCategory->update($data);
        
        return redirect()->route('admin.equipe-categories.index')->with('success', 'Catégorie mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EquipeCategory $equipeCategory)
    {
        // Vérifier si la catégorie contient des membres d'équipe
        if ($equipeCategory->equipes()->count() > 0) {
            return redirect()->route('admin.equipe-categories.index')
                ->with('error', 'Impossible de supprimer cette catégorie car elle contient des membres d\'équipe');
        }
        
        $equipeCategory->delete();
        
        return redirect()->route('admin.equipe-categories.index')->with('success', 'Catégorie supprimée avec succès');
    }

    /**
     * Update the order of categories.
     */
    public function updateOrder(Request $request)
    {
        $order = $request->input('order', []);
        
        foreach ($order as $position => $id) {
            EquipeCategory::where('id', $id)->update(['position' => $position]);
        }
        
        return response()->json(['success' => true]);
    }
}
