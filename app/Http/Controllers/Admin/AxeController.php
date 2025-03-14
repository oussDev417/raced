<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AxeRequest;
use App\Models\Axe;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class AxeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $axes = Axe::latest()->get();
        return view('admin.axes.index', compact('axes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.axes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AxeRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $this->generateSlug($data['title']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Redimensionner et sauvegarder l'image
            $manager = new ImageManager(new Driver());
            $manager->read($image)
                ->cover(800, 600)
                ->save(public_path('storage/axes/' . $imageName));
            
            $data['image'] = $imageName;
        }
        
        Axe::create($data);
        
        return redirect()->route('admin.axes.index')->with('success', 'Axe créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $axe = Axe::where('slug', $slug)->first();
        return view('admin.axes.show', compact('axe'));
    }

    public function generateSlug($title)
    {
        return Str::slug($title);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Axe $axe)
    {
        return view('admin.axes.edit', compact('axe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AxeRequest $request, Axe $axe)
    {
        $data = $request->validated();
        $data['slug'] = $this->generateSlug($data['title']);
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($axe->image && Storage::exists('public/axes/' . $axe->image)) {
                Storage::delete('public/axes/' . $axe->image);
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Redimensionner et sauvegarder l'image
            $manager = new ImageManager(new Driver());
            $manager->read($image)
                ->cover(800, 600)
                ->save(public_path('storage/axes/' . $imageName));
            
            $data['image'] = $imageName;
        }
        
        $axe->update($data);
        
        return redirect()->route('admin.axes.index')->with('success', 'Axe mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Axe $axe)
    {
        // Supprimer l'image associée
        if ($axe->image && Storage::exists('public/axes/' . $axe->image)) {
            Storage::delete('public/axes/' . $axe->image);
        }
        
        $axe->delete();
        
        return redirect()->route('admin.axes.index')->with('success', 'Axe supprimé avec succès');
    }
}
