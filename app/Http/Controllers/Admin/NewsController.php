<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::with('category')->latest()->get();
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = NewsCategory::all();
        return view('admin.news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $filename = time() . '_' . $image->getClientOriginalName();
            
            // Redimensionner et sauvegarder l'image avec Intervention Image v3
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image->getRealPath());
            $img->cover(800, 600);
            
            // Sauvegarder l'image redimensionnée
            $path = 'public/news/' . $filename;
            Storage::put($path, $img->toJpeg());
            
            $data['thumbnail'] = 'storage/news/' . $filename;
        }
        
        News::create($data);
        
        return redirect()->route('admin.news.index')->with('success', 'Actualité créée avec succès');
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
    public function edit(News $news)
    {
        $categories = NewsCategory::all();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsRequest $request, News $news)
    {
        $data = $request->validated();
        
        if ($request->hasFile('thumbnail')) {
            // Supprimer l'ancienne image
            if ($news->thumbnail) {
                $oldPath = str_replace('storage/', 'public/', $news->thumbnail);
                Storage::delete($oldPath);
            }
            
            $image = $request->file('thumbnail');
            $filename = time() . '_' . $image->getClientOriginalName();
            
            // Redimensionner et sauvegarder l'image avec Intervention Image v3
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image->getRealPath());
            $img->cover(800, 600);
            
            // Sauvegarder l'image redimensionnée
            $path = 'public/news/' . $filename;
            Storage::put($path, $img->toJpeg());
            
            $data['thumbnail'] = 'storage/news/' . $filename;
        }
        
        $news->update($data);
        
        return redirect()->route('admin.news.index')->with('success', 'Actualité mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        // Supprimer l'image associée
        if ($news->thumbnail) {
            $path = str_replace('storage/', 'public/', $news->thumbnail);
            Storage::delete($path);
        }
        
        $news->delete();
        
        return redirect()->route('admin.news.index')->with('success', 'Actualité supprimée avec succès');
    }
}
