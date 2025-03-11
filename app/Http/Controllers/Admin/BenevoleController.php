<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BenevoleRequest;
use App\Models\Benevole;

class BenevoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $benevoles = Benevole::latest()->get();
        return view('admin.benevoles.index', compact('benevoles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.benevoles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BenevoleRequest $request)
    {
        $data = $request->validated();
        
        Benevole::create($data);
        
        return redirect()->route('admin.benevoles.index')->with('success', 'Bénévole créé avec succès');
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
    public function edit(Benevole $benevole)
    {
        return view('admin.benevoles.edit', compact('benevole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BenevoleRequest $request, Benevole $benevole)
    {
        $data = $request->validated();
        
        $benevole->update($data);
        
        return redirect()->route('admin.benevoles.index')->with('success', 'Bénévole mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Benevole $benevole)
    {
        $benevole->delete();
        
        return redirect()->route('admin.benevoles.index')->with('success', 'Bénévole supprimé avec succès');
    }
}
