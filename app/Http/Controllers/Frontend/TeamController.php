<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Equipe;
use App\Models\EquipeCategory;
use App\Models\Partner;
use App\Models\Setting;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $categories = EquipeCategory::all();
        $equipes = Equipe::all();
        $equipeCategories = EquipeCategory::with('equipes')->get();
        $partners = Partner::latest()->get();
        $settings = Setting::first();

        // Récupérer la page "Équipes" depuis la base de données
        $page = \App\Models\Page::where('slug', 'equipe')->first();
        
        // Récupérer les sections de la page en utilisant le service de cache
        $pageSections = [];
        if ($page) {
            $pageSections = \App\Services\SectionCacheService::getSections($page->id);
        }
        
        // Récupérer toutes les données communes des sections depuis le cache
        $cachedData = \App\Services\SectionCacheService::getSectionData();

        // Combiner toutes les données pour la vue
        $viewData = array_merge(
            [
                'categories' => $categories, 
                'equipes' => $equipes, 
                'equipeCategories' => $equipeCategories, 
                'partners' => $partners, 
                'settings' => $settings,
                'page' => $page,
                'pageSections' => $pageSections
            ],
            $cachedData
        );

        return view('frontend.team.index', $viewData);
    }
}
