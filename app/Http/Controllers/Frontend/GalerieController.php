<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Galerie;
use App\Models\Setting;
use Illuminate\Http\Request;

class GalerieController extends Controller
{
    /**
     * Affiche la galerie d'images avec pagination.
     */
    public function index()
    {
        // Récupérer les paramètres d'en-tête et de pied de page
        $settings = Setting::first();

        // Récupérer les images de la galerie avec pagination (12 par page)
        $galeries = Galerie::latest()->paginate(12);

        // Récupérer le nombre total d'images
        $totalImages = Galerie::count();

        return view('frontend.galerie', compact(
            'settings',
            'galeries',
            'totalImages'
        ));
    }

    /**
     * Affiche une image spécifique de la galerie.
     */
    public function show($id)
    {
        // Récupérer les paramètres d'en-tête et de pied de page
        $settings = Setting::first();

        // Récupérer l'image spécifique
        $galerie = Galerie::findOrFail($id);

        // Récupérer l'image précédente
        $previousImage = Galerie::where('id', '<', $galerie->id)
            ->orderBy('id', 'desc')
            ->first();

        // Récupérer l'image suivante
        $nextImage = Galerie::where('id', '>', $galerie->id)
            ->orderBy('id', 'asc')
            ->first();

        // Récupérer d'autres images pour la section "Voir aussi" (4 images aléatoires)
        $relatedImages = Galerie::where('id', '!=', $galerie->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('frontend.galerie-detail', compact(
            'settings',
            'galerie',
            'previousImage',
            'nextImage',
            'relatedImages'
        ));
    }
}
