<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HeaderFooterSettingRequest;
use App\Models\HeaderFooterSetting;
use Illuminate\Http\Request;

class HeaderFooterSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = HeaderFooterSetting::first();
        return view('admin.header-footer-settings.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Vérifier si une configuration existe déjà
        if (HeaderFooterSetting::exists()) {
            return redirect()->route('admin.header-footer-settings.index')
                ->with('error', 'Une configuration existe déjà. Vous pouvez seulement la modifier.');
        }

        return view('admin.header-footer-settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HeaderFooterSettingRequest $request)
    {
        // Vérifier si une configuration existe déjà
        if (HeaderFooterSetting::exists()) {
            return redirect()->route('admin.header-footer-settings.index')
                ->with('error', 'Une configuration existe déjà. Vous pouvez seulement la modifier.');
        }

        $data = $request->validated();
        
        HeaderFooterSetting::create($data);
        
        return redirect()->route('admin.header-footer-settings.index')
            ->with('success', 'Configuration créée avec succès');
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
    public function edit(HeaderFooterSetting $headerFooterSetting)
    {
        return view('admin.header-footer-settings.edit', compact('headerFooterSetting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HeaderFooterSettingRequest $request, HeaderFooterSetting $headerFooterSetting)
    {
        $data = $request->validated();
        
        $headerFooterSetting->update($data);
        
        return redirect()->route('admin.header-footer-settings.index')
            ->with('success', 'Configuration mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeaderFooterSetting $headerFooterSetting)
    {
        $headerFooterSetting->delete();
        
        return redirect()->route('admin.header-footer-settings.index')
            ->with('success', 'Configuration supprimée avec succès');
    }
}
