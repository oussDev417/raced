<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutRequest;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('about.edit');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutRequest $request)
    {
        // Vérifier si une entrée existe déjà
        if (About::exists()) {
            return redirect()->route('admin.about.index')
                ->with('error', 'Une section "À propos" existe déjà. Vous pouvez seulement la modifier.');
        }

        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Redimensionner et sauvegarder l'image avec Intervention Image v3
            $manager = new ImageManager(new Driver());
            $manager->read($image)
                ->cover(800, 600)
                ->save(public_path('storage/about/' . $imageName));
            
            $data['image'] = $imageName;
        }
        
        About::create($data);
        
        return redirect()->route('admin.about.index')->with('success', 'Section "À propos" créée avec succès');
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
    public function edit()
    {
        $about = About::first() ?? new About();
        return view('admin.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AboutRequest $request)
    {
        $about = About::first() ?? new About();
        
        // Mise à jour des champs textuels
        $about->title = $request->title;
        $about->subtitle = $request->subtitle;
        $about->short_description = $request->short_description;
        $about->description = $request->description;
        $about->mission = $request->mission;
        $about->vision = $request->vision;
        $about->values = $request->values;

        // Gestion de l'image principale
        if ($request->hasFile('main_image')) {
            // Suppression de l'ancienne image si elle existe
            if ($about->main_image && Storage::exists($about->main_image)) {
                Storage::delete($about->main_image);
            }
            
            $path = $request->file('main_image')->store('about', 'public');
            $about->main_image = 'storage/' . $path;
        }

        // Gestion de l'image secondaire
        if ($request->hasFile('secondary_image')) {
            // Suppression de l'ancienne image si elle existe
            if ($about->secondary_image && Storage::exists($about->secondary_image)) {
                Storage::delete($about->secondary_image);
            }
            
            $path = $request->file('secondary_image')->store('about', 'public');
            $about->secondary_image = 'storage/' . $path;
        }

        $about->save();

        return redirect()
            ->route('admin.about.edit')
            ->with('success', 'La page À propos a été mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        // Supprimer l'image associée
        if ($about->image && Storage::exists('public/about/' . $about->image)) {
            Storage::delete('public/about/' . $about->image);
        }
        
        $about->delete();
        
        return redirect()->route('admin.about.index')->with('success', 'Section "À propos" supprimée avec succès');
    }
}
