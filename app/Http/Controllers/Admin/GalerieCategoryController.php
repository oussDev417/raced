<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalerieCategoryRequest;
use App\Models\GalerieCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalerieCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = GalerieCategory::withCount('galeries as images_count')
            ->orderBy('name')
            ->get();
            
        return view('admin.gallery.categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalerieCategoryRequest $request)
    {
        $category = new GalerieCategory();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->save();

        return redirect()->route('admin.gallery.categories.index')
            ->with('success', 'Catégorie ajoutée avec succès.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalerieCategoryRequest $request, GalerieCategory $category)
    {
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->save();

        return redirect()->route('admin.gallery.categories.index')
            ->with('success', 'Catégorie mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GalerieCategory $category)
    {
        // Vérifier si des images sont associées à cette catégorie
        if ($category->galeries()->count() > 0) {
            // Dissocier les images de cette catégorie plutôt que de les supprimer
            $category->galeries()->update(['galerie_category_id' => null]);
        }
        
        $category->delete();

        return redirect()->route('admin.gallery.categories.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }
} 