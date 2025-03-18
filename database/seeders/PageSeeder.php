<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Accueil',
                'slug' => 'accueil',
                'meta_description' => 'Bienvenue sur mon site web dynamique',
                'meta_keywords' => 'accueil, bienvenue, site web',
                'template' => 'default',
                'status' => 'published',
                'is_home' => true,
                'show_in_menu' => true,
                'menu_order' => 1,
            ],
            [
                'title' => 'À propos',
                'slug' => 'a-propos',
                'meta_description' => 'Apprenez-en plus sur notre entreprise, notre mission et nos valeurs',
                'meta_keywords' => 'à propos, entreprise, mission, valeurs',
                'template' => 'default',
                'status' => 'published',
                'is_home' => false,
                'show_in_menu' => true,
                'menu_order' => 2,
            ],
            [
                'title' => 'Services',
                'slug' => 'services',
                'meta_description' => 'Explorez la gamme complète de services que nous proposons',
                'meta_keywords' => 'services, offres, solutions',
                'template' => 'default',
                'status' => 'published',
                'is_home' => false,
                'show_in_menu' => true,
                'menu_order' => 3,
            ],
            [
                'title' => 'Blog',
                'slug' => 'blog',
                'meta_description' => 'Lisez nos derniers articles et actualités',
                'meta_keywords' => 'blog, articles, actualités',
                'template' => 'default',
                'status' => 'published',
                'is_home' => false,
                'show_in_menu' => true,
                'menu_order' => 4,
            ],
            [
                'title' => 'Contact',
                'slug' => 'contact',
                'meta_description' => 'Contactez-nous pour toute question ou demande',
                'meta_keywords' => 'contact, nous contacter, formulaire',
                'template' => 'default',
                'status' => 'published',
                'is_home' => false,
                'show_in_menu' => true,
                'menu_order' => 5,
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
} 