<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Affiche le formulaire des paramètres du site.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $settings = Setting::getSiteSettings();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Met à jour les paramètres du site.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $settings = Setting::findOrFail($id);
        
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_slogan' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
            'footer_text' => 'nullable|string',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'bank_number' => 'nullable|string|max:20',
            'contact_address' => 'nullable|string',
            'google_maps' => 'nullable|string',
            'contact_hours' => 'nullable|string',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'whatsapp_number' => 'nullable|string|max:20',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'google_analytics' => 'nullable|string',
        ]);
        
        // Traitement du logo
        if ($request->hasFile('logo')) {
            // Supprimer l'ancien logo s'il existe
            if ($settings->logo && Storage::exists('public/' . $settings->logo)) {
                Storage::delete('public/' . $settings->logo);
            }
            
            $logoPath = $request->file('logo')->store('uploads/settings', 'public');
            $validated['logo'] = $logoPath;
        }
        
        // Traitement du favicon
        if ($request->hasFile('favicon')) {
            // Supprimer l'ancien favicon s'il existe
            if ($settings->favicon && Storage::exists('public/' . $settings->favicon)) {
                Storage::delete('public/' . $settings->favicon);
            }
            
            $faviconPath = $request->file('favicon')->store('uploads/settings', 'public');
            $validated['favicon'] = $faviconPath;
        }
        
        $settings->update($validated);
        
        return redirect()->route('admin.settings.index')->with('success', 'Les paramètres du site ont été mis à jour avec succès.');
    }
} 