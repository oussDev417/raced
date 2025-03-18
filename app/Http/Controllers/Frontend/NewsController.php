<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Partner;
use App\Models\Galerie;
use App\Models\GalerieCategory;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Affiche la liste des actualités avec pagination et filtrage par catégorie.
     */
    public function index(Request $request)
    {
        // Récupérer les paramètres d'en-tête et de pied de page
        $settings = Setting::first();

        // Récupérer toutes les catégories pour le filtre
        $categories = NewsCategory::withCount('news')->get();

        // Construire la requête de base
        $query = News::with('category')->latest();

        // Filtrer par catégorie si spécifié
        if ($request->has('category') && $request->category != 'all') {
            $query->where('news_category_id', $request->category);
        }

        // Récupérer les actualités avec pagination (9 par page)
        $news = $query->paginate(9)->withQueryString();

        // Récupérer les actualités récentes pour la sidebar
        $recentNews = News::latest()->take(5)->get();

        $partners = Partner::latest()->get();

        $gallery = Galerie::latest()->get();
        $galleryCategories = GalerieCategory::with('galeries')->get();

        // Récupérer la page "Actualités" depuis la base de données
        $page = \App\Models\Page::where('slug', 'actualites')->first();
        
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
                'settings' => $settings,
                'categories' => $categories,
                'news' => $news,
                'recentNews' => $recentNews,
                'partners' => $partners,
                'gallery' => $gallery,
                'galleryCategories' => $galleryCategories,
                'page' => $page,
                'pageSections' => $pageSections
            ],
            $cachedData
        );

        return view('frontend.news.index', $viewData);
    }

    /**
     * Affiche les détails d'une actualité spécifique.
     */
    public function show($slug)
    {
        // Récupérer les paramètres d'en-tête et de pied de page
        $settings = Setting::first();

        // Récupérer l'actualité avec sa catégorie
        $news = News::with('category')->where('slug', $slug)->firstOrFail();

        // Récupérer les actualités récentes pour la sidebar (excluant l'actualité courante)
        $recentNews = News::where('id', '!=', $news->id)
            ->latest()
            ->take(5)
            ->get();

        // Récupérer les actualités reliées (même catégorie, excluant l'actualité courante)
        $relatedNews = News::where('id', '!=', $news->id)
            ->where('news_category_id', $news->news_category_id)
            ->latest()
            ->take(3)
            ->get();

        // Récupérer toutes les catégories pour la sidebar
        $categories = NewsCategory::withCount('news')->get();

        $partners = Partner::latest()->get();

        return view('frontend.news.show', compact(
            'settings',
            'news',
            'recentNews',
            'relatedNews',
            'categories',
            'partners'
        ));
    }
}
