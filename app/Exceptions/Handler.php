<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use App\Models\Setting;
use stdClass;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        // Gestion personnalisée des erreurs 404
        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            // Récupérer les paramètres à partager avec les vues
            $viewData = $this->getSharedViewData();
            
            // Vérifier si l'URL demandée commence par /admin
            if ($request->is('admin/*') || $request->is('admin')) {
                return response()->view('errors.admin-404', $viewData, 404);
            }
            
            // Sinon, afficher la page 404 du frontend
            return response()->view('errors.404', $viewData, 404);
        });
        
        // Gestion de toutes les autres exceptions
        $this->renderable(function (Throwable $e, Request $request) {
            if ($e instanceof NotFoundHttpException) {
                // Déjà géré par le code ci-dessus
                return null;
            }
            
            // Si en mode de production, afficher les pages d'erreur personnalisées
            if (app()->environment('production')) {
                $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
                
                // Récupérer les paramètres à partager avec les vues
                $viewData = $this->getSharedViewData();
                
                // Pour l'administration
                if ($request->is('admin/*') || $request->is('admin')) {
                    return response()->view('errors.admin-500', $viewData, $statusCode);
                }
                
                // Pour le frontend
                return response()->view('errors.500', $viewData, $statusCode);
            }
            
            return null; // Laisser Laravel gérer en mode de développement
        });
    }
    
    /**
     * Récupérer les données partagées pour les vues d'erreur
     * 
     * @return array
     */
    private function getSharedViewData()
    {
        try {
            // Essayer de récupérer les paramètres depuis la base de données
            $settingsModel = Setting::getSiteSettings();
            
            // Si nous n'avons pas pu récupérer les paramètres, créer un objet par défaut
            if (!$settingsModel) {
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
            } else {
                // Convertir le modèle en objet pour faciliter l'accès aux propriétés
                $settings = (object) $settingsModel->toArray();
            }
            
            return ['settings' => $settings];
        } catch (\Exception $e) {
            // En cas d'erreur, créer un objet settings par défaut
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
            
            return ['settings' => $settings];
        }
    }
} 