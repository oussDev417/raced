<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartnerRequest;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::latest()->get();
        return view('admin.partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PartnerRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Redimensionner et sauvegarder l'image
            $manager = new ImageManager(new Driver());
            $manager->read($image)
                ->resize(300, 200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save(public_path('storage/partners/' . $imageName));
            
            $data['image'] = $imageName;
        }
        
        Partner::create($data);
        
        return redirect()->route('admin.partners.index')->with('success', 'Partenaire créé avec succès');
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
    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PartnerRequest $request, Partner $partner)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($partner->image && Storage::exists('public/partners/' . $partner->image)) {
                Storage::delete('public/partners/' . $partner->image);
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Redimensionner et sauvegarder l'image
            $manager = new ImageManager(new Driver());
            $manager->read($image)
                ->resize(300, 200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save(public_path('storage/partners/' . $imageName));
            
            $data['image'] = $imageName;
        }
        
        $partner->update($data);
        
        return redirect()->route('admin.partners.index')->with('success', 'Partenaire mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        // Supprimer l'image associée
        if ($partner->image && Storage::exists('public/partners/' . $partner->image)) {
            Storage::delete('public/partners/' . $partner->image);
        }
        
        $partner->delete();
        
        return redirect()->route('admin.partners.index')->with('success', 'Partenaire supprimé avec succès');
    }

    /**
     * Update the order of partners.
     */
    public function updateOrder(Request $request)
    {
        $order = $request->input('order', []);
        
        foreach ($order as $position => $id) {
            Partner::where('id', $id)->update(['position' => $position]);
        }
        
        return response()->json(['success' => true]);
    }
}
