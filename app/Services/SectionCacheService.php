<?php

namespace App\Services;

use App\Models\Page;
use App\Models\PageSection;
use App\Models\Section;
use Illuminate\Support\Facades\Cache;

class SectionCacheService
{
    /**
     * Temps de cache en minutes pour les sections (24 heures par défaut)
     */
    const CACHE_TIME = 1440;
    
    /**
     * Récupère les sections d'une page depuis le cache ou la base de données
     * 
     * @param int $pageId Identifiant de la page
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getSections($pageId)
    {
        $cacheKey = "page_sections_{$pageId}";
        
        return Cache::remember($cacheKey, self::CACHE_TIME, function () use ($pageId) {
            return PageSection::where('page_id', $pageId)
                ->where('is_active', true)
                ->with('section')
                ->orderBy('order')
                ->get();
        });
    }
    
    /**
     * Récupère les données nécessaires pour toutes les sections depuis le cache ou la base de données
     * 
     * @return array
     */
    public static function getSectionData()
    {
        return Cache::remember('all_section_data', self::CACHE_TIME, function () {
            return [
                'about' => \App\Models\About::first(),
                'sliders' => \App\Models\Slider::where('status', 1)->latest()->get(),
                'equipeCategories' => \App\Models\EquipeCategory::with('equipes')->get(),
                'equipes' => \App\Models\Equipe::latest()->take(4)->get(),
                'news' => \App\Models\News::with('category')->latest()->take(3)->get(),
                'projects' => \App\Models\Project::latest()->take(6)->get(),
                'partners' => \App\Models\Partner::latest()->get(),
                'statFacts' => \App\Models\StatFact::latest()->get(),
                'axes' => \App\Models\Axe::latest()->get(),
                'testimonials' => \App\Models\Testimonial::latest()->get(),
                'galeries' => \App\Models\Galerie::latest()->take(8)->get(),
                'settings' => \App\Models\Setting::first(),
            ];
        });
    }
    
    /**
     * Récupère des données spécifiques pour un type de section depuis le cache
     * 
     * @param string $type Type de section (clé dans le tableau de données)
     * @return mixed
     */
    public static function getSectionDataByType($type)
    {
        $allData = self::getSectionData();
        return $allData[$type] ?? null;
    }
    
    /**
     * Vider le cache des sections pour une page spécifique
     * 
     * @param int $pageId Identifiant de la page
     * @return void
     */
    public static function clearPageCache($pageId)
    {
        Cache::forget("page_sections_{$pageId}");
    }
    
    /**
     * Vider le cache pour un type de données spécifique
     * 
     * @param string $modelType Type de modèle mis à jour
     * @return void
     */
    public static function clearModelCache($modelType)
    {
        // Vide tout le cache des données de section, car différents modèles
        // peuvent être utilisés dans différentes sections
        Cache::forget('all_section_data');
    }
    
    /**
     * Vider tout le cache des sections
     * 
     * @return void
     */
    public static function clearAllCache()
    {
        // Vider le cache de données
        Cache::forget('all_section_data');
        
        // Vider les caches de sections de page en utilisant un préfixe
        $keys = Cache::getStore()->many(Cache::getStore()->all());
        foreach ($keys as $key => $value) {
            if (strpos($key, 'page_sections_') === 0) {
                Cache::forget($key);
            }
        }
    }
} 