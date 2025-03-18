<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array
     */
    protected $fillable = [
        'site_name',
        'site_slogan',
        'logo',
        'favicon',
        'footer_text',
        'contact_email',
        'contact_phone',
        'contact_address',
        'bank_number',
        'google_maps',
        'contact_hours',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'linkedin_url',
        'youtube_url',
        'whatsapp_number',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'google_analytics',
    ];

    /**
     * Récupère les paramètres du site ou crée une entrée par défaut si aucune n'existe.
     *
     * @return \App\Models\Setting
     */
    public static function getSiteSettings()
    {
        $settings = self::first();
        
        if (!$settings) {
            $settings = self::create([
                'site_name' => 'Mon Site',
                'site_slogan' => 'Une description de mon site',
                'footer_text' => '© ' . date('Y') . ' - Tous droits réservés',
            ]);
        }
        
        return $settings;
    }
} 