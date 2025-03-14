<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalerieRequest;
use App\Models\Galerie;
use App\Models\GalerieCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class GalerieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Galerie::with('category')
            ->orderBy('position')
            ->paginate(12);
        $categories = GalerieCategory::orderBy('name')->get();
        
        return view('admin.gallery.index', compact('images', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = GalerieCategory::orderBy('name')->get();
        return view('admin.gallery.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalerieRequest $request)
    {
        $image = new Galerie();
        $image->title = $request->title;
        $image->description = $request->description;
        $image->galerie_category_id = $request->category_id;
        
        // Déterminer la position maximale actuelle et ajouter 1
        $maxPosition = Galerie::max('position') ?? 0;
        $image->position = $maxPosition + 1;
        
        // Traitement de l'image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // S'assurer que le répertoire existe
            $uploadPath = public_path('uploads/gallery');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Utiliser Intervention Image v3 pour optimiser l'image
            try {
                $manager = new ImageManager(new Driver());
                $manager->read($file)
                    ->resize(1200, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->save($uploadPath . '/' . $filename);
                    
                $image->path = 'uploads/gallery/' . $filename;
            } catch (\Intervention\Image\Exceptions\NotWritableException $e) {
                return redirect()->back()
                    ->with('error', 'Impossible d\'enregistrer l\'image. Vérifiez les permissions du dossier.')
                    ->withInput();
            } catch (\Exception $e) {
                return redirect()->back()
                    ->with('error', 'Une erreur est survenue lors du traitement de l\'image: ' . $e->getMessage())
                    ->withInput();
            }
        }
        
        $image->save();
        
        return redirect()->route('admin.gallery.index')
            ->with('success', 'Image ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $image = Galerie::with('category')->findOrFail($id);
        return view('admin.gallery.show', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galerie $galerie)
    {
        $categories = GalerieCategory::orderBy('name')->get();
        $image = $galerie;
        return view('admin.gallery.edit', compact('image', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalerieRequest $request, Galerie $galerie)
    {
        $galerie->title = $request->title;
        $galerie->description = $request->description;
        $galerie->galerie_category_id = $request->category_id;
        
        // Traitement de l'image si une nouvelle est fournie
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($galerie->path && file_exists(public_path($galerie->path))) {
                unlink(public_path($galerie->path));
            }
            
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Utiliser Intervention Image v3 pour optimiser l'image
            $manager = new ImageManager(new Driver());
            $manager->read($file)
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save(public_path('uploads/gallery/' . $filename));
                
            $galerie->path = 'uploads/gallery/' . $filename;
        }
        
        $galerie->save();
        
        return redirect()->route('admin.gallery.index')
            ->with('success', 'Image mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galerie $galerie)
    {
        // Supprimer l'image associée
        if ($galerie->path && file_exists(public_path($galerie->path))) {
            unlink(public_path($galerie->path));
        }
        
        $galerie->delete();
        
        return redirect()->route('admin.gallery.index')->with('success', 'Image supprimée de la galerie avec succès');
    }

    /**
     * Update the order of gallery images.
     */
    public function updateOrder(Request $request)
    {
        $order = $request->input('order', []);
        
        foreach ($order as $position => $id) {
            Galerie::where('id', $id)->update(['position' => $position]);
        }
        
        return response()->json(['success' => true]);
    }
}
