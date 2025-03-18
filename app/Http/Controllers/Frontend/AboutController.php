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
use App\Models\Testimonial;
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

        // Récupérer la page "À propos" depuis la base de données
        $page = \App\Models\Page::where('slug', 'a-propos')->first();
        
        // Récupérer les sections de la page en utilisant le service de cache
        $pageSections = [];
        if ($page) {
            $pageSections = \App\Services\SectionCacheService::getSections($page->id);
        }
        
        // Récupérer toutes les données communes des sections depuis le cache
        $cachedData = \App\Services\SectionCacheService::getSectionData();

        // Récupérer les axes d'intervention
        $axes = Axe::latest()->get();

        // Récupérer les fun facts
        $funFacts = FunFact::latest()->get();

        // Récupérer les statistiques
        $statFacts = StatFact::latest()->get();

        // Récupérer les équipes
        $equipes = Equipe::all();

        // Récupérer les témoignages
        $testimonials = Testimonial::all();

        // Récupérer les catégories d'équipe avec leurs membres
        $equipeCategories = EquipeCategory::with('equipes')->get();

        // Récupérer les partenaires
        $partners = Partner::latest()->get();

        // Combinaison des données pour la vue
        $viewData = array_merge(
            [
                'settings' => $settings,
                'about' => $about,
                'page' => $page,
                'pageSections' => $pageSections,
                'axes' => $axes,
                'funFacts' => $funFacts,
                'statFacts' => $statFacts,
                'equipeCategories' => $equipeCategories,
                'equipes' => $equipes,
                'testimonials' => $testimonials,
                'partners' => $partners
            ],
            $cachedData
        );

        return view('frontend.about.index', $viewData);
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

        return view('frontend.axes.index', compact(
            'settings',
            'axes',
            'statFacts'
        ));
    }

    public function show($slug)
    {
        $axe = Axe::where('slug', $slug)->first();
        $settings = Setting::first();

        return view('frontend.axes.show', compact(
            'settings',
            'axe'
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
