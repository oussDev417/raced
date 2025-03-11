<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EquipeRequest;
use App\Models\Equipe;
use App\Models\EquipeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class EquipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipes = Equipe::with('category')->latest()->get();
        return view('admin.equipes.index', compact('equipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = EquipeCategory::all();
        return view('admin.equipes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EquipeRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Redimensionner et sauvegarder l'image
            $manager = new ImageManager(new Driver());
            $manager->read($image)
                ->cover(400, 500)
                ->save(public_path('storage/equipes/' . $imageName));
            
            $data['image'] = $imageName;
        }
        
        Equipe::create($data);
        
        return redirect()->route('admin.equipes.index')->with('success', 'Membre d\'équipe créé avec succès');
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
    public function edit(Equipe $equipe)
    {
        $categories = EquipeCategory::all();
        return view('admin.equipes.edit', compact('equipe', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EquipeRequest $request, Equipe $equipe)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($equipe->image && Storage::exists('public/equipes/' . $equipe->image)) {
                Storage::delete('public/equipes/' . $equipe->image);
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Redimensionner et sauvegarder l'image
            $manager = new ImageManager(new Driver());
            $manager->read($image)
                ->cover(400, 500)
                ->save(public_path('storage/equipes/' . $imageName));
            
            $data['image'] = $imageName;
        }
        
        $equipe->update($data);
        
        return redirect()->route('admin.equipes.index')->with('success', 'Membre d\'équipe mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipe $equipe)
    {
        // Supprimer l'image associée
        if ($equipe->image && Storage::exists('public/equipes/' . $equipe->image)) {
            Storage::delete('public/equipes/' . $equipe->image);
        }
        
        $equipe->delete();
        
        return redirect()->route('admin.equipes.index')->with('success', 'Membre d\'équipe supprimé avec succès');
    }

    /**
     * Update the order of team members within their category.
     */
    public function updateOrder(Request $request)
    {
        $order = $request->input('order', []);
        
        foreach ($order as $position => $id) {
            Equipe::where('id', $id)->update(['position' => $position]);
        }
        
        return response()->json(['success' => true]);
    }
}
