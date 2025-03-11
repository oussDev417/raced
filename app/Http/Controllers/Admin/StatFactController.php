<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatFactRequest;
use App\Models\StatFact;
use Illuminate\Http\Request;

class StatFactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statFacts = StatFact::latest()->get();
        return view('admin.stat-facts.index', compact('statFacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stat-facts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatFactRequest $request)
    {
        $data = $request->validated();
        
        StatFact::create($data);
        
        return redirect()->route('admin.stat-facts.index')->with('success', 'Statistique créée avec succès');
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
    public function edit(StatFact $statFact)
    {
        return view('admin.stat-facts.edit', compact('statFact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StatFactRequest $request, StatFact $statFact)
    {
        $data = $request->validated();
        
        $statFact->update($data);
        
        return redirect()->route('admin.stat-facts.index')->with('success', 'Statistique mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StatFact $statFact)
    {
        $statFact->delete();
        
        return redirect()->route('admin.stat-facts.index')->with('success', 'Statistique supprimée avec succès');
    }

    /**
     * Update the order of stat facts.
     */
    public function updateOrder(Request $request)
    {
        $order = $request->input('order', []);
        
        foreach ($order as $position => $id) {
            StatFact::where('id', $id)->update(['position' => $position]);
        }
        
        return response()->json(['success' => true]);
    }
}
