<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HeaderSliderRequest;
use App\Models\HeaderSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class HeaderSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = HeaderSlider::latest()->get();
        return view('admin.header-sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.header-sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HeaderSliderRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Redimensionner et sauvegarder l'image
            $manager = new ImageManager(new Driver());
            $manager->read($image)
                ->cover(1920, 800)
                ->save(public_path('storage/sliders/' . $imageName));
            
            $data['image'] = $imageName;
        }
        
        HeaderSlider::create($data);
        
        return redirect()->route('admin.header-sliders.index')->with('success', 'Slider créé avec succès');
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
    public function edit(HeaderSlider $headerSlider)
    {
        return view('admin.header-sliders.edit', compact('headerSlider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HeaderSliderRequest $request, HeaderSlider $headerSlider)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($headerSlider->image && Storage::exists('public/sliders/' . $headerSlider->image)) {
                Storage::delete('public/sliders/' . $headerSlider->image);
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Redimensionner et sauvegarder l'image
            $manager = new ImageManager(new Driver());
            $manager->read($image)
                ->cover(1920, 800)
                ->save(public_path('storage/sliders/' . $imageName));
            
            $data['image'] = $imageName;
        }
        
        $headerSlider->update($data);
        
        return redirect()->route('admin.header-sliders.index')->with('success', 'Slider mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeaderSlider $headerSlider)
    {
        // Supprimer l'image associée
        if ($headerSlider->image && Storage::exists('public/sliders/' . $headerSlider->image)) {
            Storage::delete('public/sliders/' . $headerSlider->image);
        }
        
        $headerSlider->delete();
        
        return redirect()->route('admin.header-sliders.index')->with('success', 'Slider supprimé avec succès');
    }

    /**
     * Update the order of sliders.
     */
    public function updateOrder(Request $request)
    {
        $order = $request->input('order', []);
        
        foreach ($order as $position => $id) {
            HeaderSlider::where('id', $id)->update(['position' => $position]);
        }
        
        return response()->json(['success' => true]);
    }
}
