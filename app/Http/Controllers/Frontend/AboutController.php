<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Axe;
use App\Models\Equipe;
use App\Models\EquipeCategory;
use App\Models\FunFact;
use App\Models\Setting;
use App\Models\Partner;
use App\Models\StatFact;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Affiche la page À propos.
     */
    public function index()
    {
        // Récupérer les paramètres d'en-tête et de pied de page
        $settings = Setting::first();

        // Récupérer les informations de la section À propos
        $about = About::first();

        // Récupérer les axes d'intervention
        $axes = Axe::latest()->get();

        // Récupérer les fun facts
        $funFacts = FunFact::latest()->get();

        // Récupérer les statistiques
        $statFacts = StatFact::latest()->get();

        // Récupérer les catégories d'équipe avec leurs membres
        $equipeCategories = EquipeCategory::with('equipes')->get();

        // Récupérer les partenaires
        $partners = Partner::latest()->get();

        return view('frontend.about.index', compact(
            'settings',
            'about',
            'axes',
            'funFacts',
            'statFacts',
            'equipeCategories',
            'partners'
        ));
    }

    /**
     * Affiche la page de l'équipe.
     */
    public function team()
    {
        // Récupérer les paramètres d'en-tête et de pied de page
        $settings = Setting::first();

        // Récupérer les catégories d'équipe avec leurs membres
        $equipeCategories = EquipeCategory::with('equipes')->get();

        return view('frontend.team', compact(
            'settings',
            'equipeCategories'
        ));
    }

    /**
     * Affiche la page des axes d'intervention.
     */
    public function axes()
    {
        // Récupérer les paramètres d'en-tête et de pied de page
        $settings = Setting::first();

        // Récupérer les axes d'intervention
        $axes = Axe::latest()->get();

        // Récupérer les statistiques
        $statFacts = StatFact::latest()->get();

        return view('frontend.axes', compact(
            'settings',
            'axes',
            'statFacts'
        ));
    }

    /**
     * Affiche la page des partenaires.
     */
    // public function partners()
    // {
    //     // Récupérer les paramètres d'en-tête et de pied de page
    //     $settings = Setting::first();

    //     // Récupérer les partenaires
    //     $partners = Partner::latest()->get();

    //     return view('frontend.partners', compact(
    //         'settings',
    //         'partners'
    //     ));
    // }
}
