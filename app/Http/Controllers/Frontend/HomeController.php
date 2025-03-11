<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Axe;
use App\Models\Equipe;
use App\Models\EquipeCategory;
use App\Models\FunFact;
use App\Models\Galerie;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\News;
use App\Models\Partner;
use App\Models\Project;
use App\Models\StatFact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Affiche la page d'accueil avec toutes les données nécessaires.
     */
    public function index()
    {
        // Récupérer les paramètres d'en-tête et de pied de page
        $settings = Setting::first();

        // Récupérer les sliders d'en-tête
        $sliders = Slider::where('status', 1)->latest()->get();

        // Récupérer la section "À propos"
        $about = About::first();

        // Récupérer les axes d'intervention
        $axes = Axe::latest()->get();

        // Récupérer les fun facts
        $funFacts = FunFact::latest()->get();

        // Récupérer les statistiques
        $statFacts = StatFact::first()->get();

        // Récupérer les projets
        $projects = Project::latest()->take(6)->get();

        // Récupérer les actualités récentes
        $news = News::with('category')->latest()->take(3)->get();

        // Récupérer les catégories d'équipe avec leurs membres
        $equipeCategories = EquipeCategory::with('equipes')->get();

        // Récupérer les partenaires
        $partners = Partner::latest()->get();

        // Récupérer les images de la galerie
        $galeries = Galerie::latest()->take(8)->get();

        return view('frontend.home.index', compact(
            'settings',
            'sliders',
            'about',
            'axes',
            'funFacts',
            'statFacts',
            'projects',
            'news',
            'equipeCategories',
            'partners',
            'galeries'
        ));
    }
}
