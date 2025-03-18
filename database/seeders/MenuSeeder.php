<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer le menu principal (header)
        $headerMenu = Menu::create([
            'name' => 'Menu Principal',
            'location' => 'header',
            'description' => 'Menu principal du site affiché dans l\'en-tête',
            'is_active' => true,
        ]);

        // Créer le menu du pied de page
        $footerMenu = Menu::create([
            'name' => 'Menu Pied de Page',
            'location' => 'footer',
            'description' => 'Menu affiché dans le pied de page',
            'is_active' => true,
        ]);

        // Créer le menu mobile
        $mobileMenu = Menu::create([
            'name' => 'Menu Mobile',
            'location' => 'mobile',
            'description' => 'Menu pour les appareils mobiles',
            'is_active' => true,
        ]);

        // Les éléments du menu principal
        $headerItems = [
            ['title' => 'Accueil', 'url' => '/', 'order' => 1],
            ['title' => 'À propos', 'url' => '/about', 'order' => 2],
            ['title' => 'Nos opportunités', 'url' => '/opportunites', 'order' => 3],
            ['title' => 'Nos projets', 'url' => '/projects', 'order' => 4],
            ['title' => 'Actualités', 'url' => '/news', 'order' => 5],
            ['title' => 'Nous contacter', 'url' => '/contact', 'order' => 6],
            ['title' => 'Nous soutenir', 'url' => '/donation', 'order' => 7],
        ];

        foreach ($headerItems as $item) {
            MenuItem::create([
                'menu_id' => $headerMenu->id,
                'title' => $item['title'],
                'url' => $item['url'],
                'order' => $item['order'],
                'is_active' => true,
            ]);
        }

        // Les éléments du menu footer
        $footerItems = [
            ['title' => 'Accueil', 'url' => '/', 'order' => 1],
            ['title' => 'À Propos', 'url' => '/about', 'order' => 2],
            ['title' => 'Actualités', 'url' => '/news', 'order' => 3],
            ['title' => 'Contactez-nous', 'url' => '/contact', 'order' => 4],
        ];

        foreach ($footerItems as $item) {
            MenuItem::create([
                'menu_id' => $footerMenu->id,
                'title' => $item['title'],
                'url' => $item['url'],
                'order' => $item['order'],
                'is_active' => true,
            ]);
        }

        // Les éléments du menu mobile sont les mêmes que le menu principal
        foreach ($headerItems as $item) {
            MenuItem::create([
                'menu_id' => $mobileMenu->id,
                'title' => $item['title'],
                'url' => $item['url'],
                'order' => $item['order'],
                'is_active' => true,
            ]);
        }
    }
} 