<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Affiche la liste des sliders.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $sliders = Slider::ordered()->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Affiche le formulaire de création d'un slider.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Enregistre un nouveau slider.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|string|max:255',
            'button_text_2' => 'nullable|string|max:50',
            'button_link_2' => 'nullable|string|max:255',
            'status' => 'boolean',
        ]);
        
        // Traitement de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/sliders', 'public');
            $validated['image'] = $imagePath;
        }
        
        // Définir l'ordre
        $lastOrder = Slider::max('order') ?? 0;
        $validated['order'] = $lastOrder + 1;
        
        Slider::create($validated);
        
        return redirect()->route('admin.sliders.index')->with('success', 'Le slider a été créé avec succès.');
    }

    /**
     * Affiche le formulaire d'édition d'un slider.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\View\View
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * Met à jour un slider.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|string|max:255',
            'button_text_2' => 'nullable|string|max:50',
            'button_link_2' => 'nullable|string|max:255',
            'status' => 'boolean',
        ]);
        
        // Traitement de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($slider->image && Storage::exists('public/' . $slider->image)) {
                Storage::delete('public/' . $slider->image);
            }
            
            $imagePath = $request->file('image')->store('uploads/sliders', 'public');
            $validated['image'] = $imagePath;
        }
        
        $slider->update($validated);
        
        return redirect()->route('admin.sliders.index')->with('success', 'Le slider a été mis à jour avec succès.');
    }

    /**
     * Supprime un slider.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Slider $slider)
    {
        // Supprimer l'image
        if ($slider->image && Storage::exists('public/' . $slider->image)) {
            Storage::delete('public/' . $slider->image);
        }
        
        $slider->delete();
        
        return redirect()->route('admin.sliders.index')->with('success', 'Le slider a été supprimé avec succès.');
    }

    /**
     * Met à jour l'ordre des sliders.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOrder(Request $request)
    {
        $sliders = $request->input('sliders', []);
        
        foreach ($sliders as $slider) {
            $item = Slider::find($slider['id']);
            if ($item) {
                $item->update(['order' => $slider['order']]);
            }
        }
        
        return response()->json(['success' => true]);
    }
} 