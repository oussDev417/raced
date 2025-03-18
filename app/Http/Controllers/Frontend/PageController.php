<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Page;
use App\Services\SectionCacheService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    /**
     * Affiche la page d'accueil.
     */
    public function home()
    {
        // Récupérer la page d'accueil depuis la base de données
        $page = Cache::remember('home_page', 1440, function () {
            $homePage = Page::where('is_home', true)->first();
            
            // Si aucune page d'accueil n'est définie, utiliser la première page publiée
            if (!$homePage) {
                $homePage = Page::where('status', 'published')->first();
            }
            
            return $homePage;
        });
        
        // Si toujours pas de page, créer un message d'erreur
        if (!$page) {
            return view('frontend.home.index', [
                'error' => 'Aucune page d\'accueil n\'a été configurée.'
            ]);
        }
        
        // Récupérer les sections de la page en utilisant le cache
        $pageSections = SectionCacheService::getSections($page->id);
        
        // Récupérer toutes les données des sections depuis le cache
        $cachedData = SectionCacheService::getSectionData();
        
        // Combinaison des données pour la vue
        $viewData = array_merge(
            ['page' => $page, 'pageSections' => $pageSections],
            $cachedData
        );
        
        return view('frontend.home.index', $viewData);
    }

    /**
     * Affiche une page dynamique spécifique.
     */
    public function show($slug)
    {
        // Récupérer la page demandée (avec cache de 24h)
        $page = Cache::remember('page_' . $slug, 1440, function () use ($slug) {
            return Page::where('slug', $slug)
                      ->where('status', 'published')
                      ->first();
        });
        
        if (!$page) {
            abort(404);
        }
        
        // Récupérer les sections de la page en utilisant le cache
        $pageSections = SectionCacheService::getSections($page->id);
        
        // Récupérer toutes les données communes des sections depuis le cache
        $cachedData = SectionCacheService::getSectionData();
        
        // Choisir le template à utiliser en fonction du paramètre de la page
        $template = $page->template ?? 'default';
        
        // Combinaison des données pour la vue
        $viewData = array_merge(
            ['page' => $page, 'pageSections' => $pageSections],
            $cachedData
        );
        
        return view("frontend.pages.{$template}", $viewData);
    }
    
    /**
     * Génère le menu pour l'affichage frontend.
     * 
     * @param string $location Emplacement du menu (header, footer, etc.)
     * @return \Illuminate\Support\Collection
     */
    private function getMenu($location = 'header')
    {
        // Récupérer le menu pour cet emplacement (avec cache)
        return Cache::remember('menu_' . $location, 1440, function () use ($location) {
            $menu = Menu::where('location', $location)
                       ->where('is_active', true)
                       ->first();
            
            if (!$menu) {
                return collect([]);
            }
            
            // Récupérer les éléments de premier niveau
            return $menu->rootItems()
                       ->where('is_active', true)
                       ->with(['children' => function($query) {
                           $query->where('is_active', true)->orderBy('order');
                       }])
                       ->get();
        });
    }
}
