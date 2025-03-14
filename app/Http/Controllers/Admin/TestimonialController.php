<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Requests\TestimonialRequest;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestimonialRequest $request)
    {
        $validated = $request->validated();
        $testimonial = Testimonial::create($validated)  ;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/testimonials'), $imageName);
            $testimonial->image = $imageName;
            $testimonial->save();
        }
        return redirect()->route('admin.testimonials.index')->with('success', 'Témoignage créé avec succès');
    }

    public function updateOrder(Request $request)
    {
        $items = $request->items;
        foreach ($items as $item) {
            $testimonial = Testimonial::find($item['id']);
            $testimonial->order = $item['order'];
            $testimonial->save();
        }
        return response()->json(['success' => true]);
    }
        
    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TestimonialRequest $request, Testimonial $testimonial)
    {
        $validated = $request->validated();
        $testimonial->update($validated);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/testimonials'), $imageName);
            $testimonial->image = $imageName;
            $testimonial->save();
        }
        return redirect()->route('admin.testimonials.index')->with('success', 'Témoignage modifié avec succès');    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Témoignage supprimé avec succès');
    }
}
