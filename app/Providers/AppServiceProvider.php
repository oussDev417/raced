<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use stdClass;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Partager les paramètres du site avec toutes les vues
        try {
            $settings = Setting::getSiteSettings();
            
            if (!$settings) {
                $settings = $this->getDefaultSettings();
            }
            
            View::share('settings', $settings);
        } catch (\Exception $e) {
            // En cas d'erreur, partager des paramètres par défaut
            View::share('settings', $this->getDefaultSettings());
        }
    }
    
    /**
     * Obtenir des paramètres par défaut
     * 
     * @return stdClass
     */
    private function getDefaultSettings()
    {
        $settings = new stdClass();
        $settings->site_name = 'RACED ONG';
        $settings->site_slogan = 'Organisation Non Gouvernementale';
        $settings->contact_address = 'Cotonou, Bénin';
        $settings->contact_phone = '+229 97 77 77 77';
        $settings->contact_email = 'contact@racedong.org';
        $settings->contact_hours = 'Lundi - Vendredi : 08:00 - 17:00';
        $settings->facebook = true;
        $settings->twitter = true;
        $settings->instagram = true;
        $settings->youtube = true;
        $settings->linkedin = true;
        $settings->whatsapp = true;
        $settings->tiktok = true;
        $settings->facebook_url = '#';
        $settings->twitter_url = '#';
        $settings->instagram_url = '#';
        $settings->youtube_url = '#';
        $settings->linkedin_url = '#';
        $settings->whatsapp_url = '#';
        $settings->tiktok_url = '#';
        $settings->footer_text = '© ' . date('Y') . ' - RACED ONG - Tous droits réservés';
        
        return $settings;
    }
}
