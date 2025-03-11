<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FunFactRequest;
use App\Models\FunFact;
use Illuminate\Http\Request;

class FunFactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $funFacts = FunFact::latest()->get();
        return view('admin.fun-facts.index', compact('funFacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fun-facts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FunFactRequest $request)
    {
        $data = $request->validated();
        
        FunFact::create($data);
        
        return redirect()->route('admin.fun-facts.index')->with('success', 'Fun fact créé avec succès');
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
    public function edit(FunFact $funFact)
    {
        return view('admin.fun-facts.edit', compact('funFact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FunFactRequest $request, FunFact $funFact)
    {
        $data = $request->validated();
        
        $funFact->update($data);
        
        return redirect()->route('admin.fun-facts.index')->with('success', 'Fun fact mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FunFact $funFact)
    {
        $funFact->delete();
        
        return redirect()->route('admin.fun-facts.index')->with('success', 'Fun fact supprimé avec succès');
    }

    /**
     * Update the order of fun facts.
     */
    public function updateOrder(Request $request)
    {
        $order = $request->input('order', []);
        
        foreach ($order as $position => $id) {
            FunFact::where('id', $id)->update(['position' => $position]);
        }
        
        return response()->json(['success' => true]);
    }
}
