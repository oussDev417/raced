<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsCategoryRequest;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class NewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = NewsCategory::withCount('news')->latest()->get();
        return view('admin.news-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsCategoryRequest $request)
    {
        $data = $request->validated();
        
        NewsCategory::create($data);
        
        return redirect()->route('admin.news-categories.index')->with('success', 'Catégorie créée avec succès');
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
    public function edit(NewsCategory $newsCategory)
    {
        return view('admin.news-categories.edit', compact('newsCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsCategoryRequest $request, NewsCategory $newsCategory)
    {
        $data = $request->validated();
        
        $newsCategory->update($data);
        
        return redirect()->route('admin.news-categories.index')->with('success', 'Catégorie mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewsCategory $newsCategory)
    {
        // Vérifier si la catégorie contient des actualités
        if ($newsCategory->news()->count() > 0) {
            return redirect()->route('admin.news-categories.index')
                ->with('error', 'Impossible de supprimer cette catégorie car elle contient des actualités');
        }
        
        $newsCategory->delete();
        
        return redirect()->route('admin.news-categories.index')->with('success', 'Catégorie supprimée avec succès');
    }

    /**
     * Update the order of categories.
     */
    public function updateOrder(Request $request)
    {
        $order = $request->input('order', []);
        
        foreach ($order as $position => $id) {
            NewsCategory::where('id', $id)->update(['position' => $position]);
        }
        
        return response()->json(['success' => true]);
    }
}
