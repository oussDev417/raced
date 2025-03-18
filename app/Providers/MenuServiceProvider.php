<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Menu;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Partager les menus avec toutes les vues
        $this->loadViewsWithMenus();
    }

    /**
     * Partage les menus avec toutes les vues
     */
    protected function loadViewsWithMenus(): void
    {
        // Vérifier si la table menus existe dans la base de données
        try {
            if (\Schema::hasTable('menus')) {
                $locations = config('menus.locations', [
                    'header' => 'En-tête',
                    'footer' => 'Pied de page',
                    'sidebar' => 'Barre latérale',
                    'mobile' => 'Mobile'
                ]);

                // Partager les emplacements avec toutes les vues admin liées aux menus
                View::composer(['admin.menus.*', 'admin.menu_items.*'], function ($view) use ($locations) {
                    $view->with('locations', $locations);
                });

                // Partager les cibles possibles pour les liens
                View::composer(['admin.menu_items.*'], function ($view) {
                    $view->with('targets', [
                        '_self' => 'Même fenêtre',
                        '_blank' => 'Nouvelle fenêtre'
                    ]);
                });

                // Charger tous les menus actifs pour le frontend
                View::composer('*', function ($view) {
                    $activeMenus = Menu::where('is_active', true)
                        ->with(['items' => function ($query) {
                            $query->where('is_active', true)
                                ->orderBy('order')
                                ->with('page', 'children');
                        }])
                        ->get()
                        ->keyBy('location');

                    $view->with('menus', $activeMenus);
                });
            }
        } catch (\Exception $e) {
            // Logger l'erreur mais ne pas planter l'application
            \Log::error('Erreur lors du chargement des menus: ' . $e->getMessage());
        }
    }
} 