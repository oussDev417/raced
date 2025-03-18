<?php

namespace App\View\Components;

use App\Models\PageSection;
use App\Services\SectionCacheService;
use Illuminate\View\Component;

class DynamicSection extends Component
{
    /**
     * La section de page à afficher.
     *
     * @var \App\Models\PageSection
     */
    public $pageSection;

    /**
     * Données complémentaires à passer à la section.
     * 
     * @var array
     */
    public $data;

    /**
     * Create a new component instance.
     */
    public function __construct(PageSection $pageSection, $data = [])
    {
        $this->pageSection = $pageSection;
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // Récupérer le type de section
        $section = $this->pageSection->section;
        
        // Si la section n'existe pas ou n'est pas active, ne rien afficher
        if (!$section || !$section->is_active || !$this->pageSection->is_active) {
            return '';
        }
        
        // Fusionner les données par défaut avec les données spécifiques à cette instance
        // S'assurer que toutes les données sont bien des tableaux avant de les fusionner
        $defaultData = is_array($section->default_data) ? $section->default_data : [];
        $sectionData = is_array($this->pageSection->section_data) ? $this->pageSection->section_data : [];
        
        $mergedData = array_merge(
            $defaultData,
            $sectionData,
            $this->data
        );
        
        // Préparer les variables de base à passer à la vue
        $viewData = [
            'pageSection' => $this->pageSection,
            'section' => $section,
            'data' => $mergedData,
            'title' => $mergedData['title'] ?? $section->title,
            'subtitle' => $mergedData['subtitle'] ?? $section->subtitle,
            'customClass' => $this->pageSection->custom_class,
        ];
        
        // Récupérer les données communes depuis le cache
        $cachedData = SectionCacheService::getSectionData();
        
        // Récupérer des données supplémentaires en fonction du type de section
        switch ($section->blade_component) {
            case 'about':
                // Récupérer les données pour la section "À propos"
                $viewData['about'] = $cachedData['about'];
                break;
                
            case 'team':
                // Récupérer les données pour la section "Équipe"
                $viewData['equipeCategories'] = $cachedData['equipeCategories'];
                $viewData['equipes'] = $cachedData['equipes'];
                break;
                
            case 'slider':
                // Récupérer les données pour la section "Slider"
                $viewData['sliders'] = $cachedData['sliders'];
                break;
                
            case 'new':
                // Récupérer les données pour la section "Actualités"
                $viewData['news'] = $cachedData['news'];
                break;
                
            case 'project':
                // Récupérer les données pour la section "Projets"
                $viewData['projects'] = $cachedData['projects'];
                break;
                
            case 'partners':
                // Récupérer les données pour la section "Partenaires"
                $viewData['partners'] = $cachedData['partners'];
                break;
                
            case 'stats':
                // Récupérer les données pour la section "Statistiques"
                $viewData['statFacts'] = $cachedData['statFacts'];
                break;
                
            case 'gallery':
                // Récupérer les données pour la section "Galerie"
                $viewData['galeries'] = $cachedData['galeries'];
                break;
                
            case 'feature':
                // Récupérer les données pour la section "Fonctionnalités"
                // Vous pouvez ajouter d'autres modèles si nécessaire
                break;
                
            case 'opportunites':
                // Récupérer les données pour la section "Opportunités"
                $viewData['axes'] = $cachedData['axes'];
                break;
                
            case 'testimonial':
                // Récupérer les données pour la section "Témoignages"
                $viewData['testimonials'] = $cachedData['testimonials'];
                break;
                
            case 'benevole':
                // Récupérer les données pour la section "Bénévoles"
                break;
                
            case 'reports':
                // Récupérer les données pour la section "Rapports"
                $viewData['reports'] = \App\Models\Report::where('active', true)
                    ->orderBy('order')
                    ->orderBy('publication_date', 'desc')
                    ->take($mergedData['max_reports'] ?? 6)
                    ->get();
                break;
                
            case 'generic_section':
                // Pour la section générique, si un ID de section est fourni, récupérer les données
                if (isset($mergedData['generic_section_id']) && $mergedData['generic_section_id']) {
                    $viewData['genericSection'] = \App\Models\GenericSection::where('id', $mergedData['generic_section_id'])
                        ->where('active', true)
                        ->first();
                }
                break;
                
            default:
                // Si aucun cas spécifique, ne rien faire de plus
                break;
        }
        
        // Retourner la vue correspondant au composant Blade de la section
        $viewName = 'frontend.layouts.partials.' . $section->blade_component;
        
        // Vérifier si la vue existe
        if (view()->exists($viewName)) {
            return view($viewName, $viewData);
        }
        
        // Si la vue n'existe pas, retourner un message d'erreur
        return view('frontend.layouts.partials.error', [
            'message' => "La vue '{$viewName}' n'existe pas."
        ]);
    }
}
