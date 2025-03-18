<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'name' => 'En-tête / Slider',
                'title' => 'Slider Principal',
                'subtitle' => null,
                'type' => 'slider',
                'blade_component' => 'slider',
                'description' => 'Section slider avec images et textes défilants',
                'default_data' => json_encode([
                    'autoplay' => true,
                    'delay' => 5000
                ]),
                'is_active' => true
            ],
            [
                'name' => 'À Propos',
                'title' => 'À Propos de Nous',
                'subtitle' => 'Découvrez notre histoire et notre mission',
                'type' => 'about',
                'blade_component' => 'about',
                'description' => 'Section présentant l\'organisation et sa mission',
                'default_data' => null,
                'is_active' => true
            ],
            [
                'name' => 'Caractéristiques',
                'title' => 'Nos Opportunités',
                'subtitle' => 'Ce que nous proposons',
                'type' => 'feature',
                'blade_component' => 'feature',
                'description' => 'Section présentant les fonctionnalités ou avantages',
                'default_data' => null,
                'is_active' => true
            ],
            [
                'name' => 'Opportunités',
                'title' => 'Nos Opportunités',
                'subtitle' => 'Explorez nos opportunités',
                'type' => 'opportunities',
                'blade_component' => 'opportunites',
                'description' => 'Section présentant les différentes opportunités',
                'default_data' => null,
                'is_active' => true
            ],
            [
                'name' => 'Projets',
                'title' => 'Nos Projets',
                'subtitle' => 'Découvrez nos projets récents',
                'type' => 'project',
                'blade_component' => 'project',
                'description' => 'Section présentant les projets récents',
                'default_data' => null,
                'is_active' => true
            ],
            [
                'name' => 'Statistiques',
                'title' => 'Nos Réalisations',
                'subtitle' => 'Voici ce que nous avons accompli',
                'type' => 'stats',
                'blade_component' => 'stats',
                'description' => 'Section présentant des statistiques et chiffres clés',
                'default_data' => null,
                'is_active' => true
            ],
            [
                'name' => 'Équipe',
                'title' => 'Notre Équipe',
                'subtitle' => 'Rencontrez nos experts',
                'type' => 'team',
                'blade_component' => 'team',
                'description' => 'Section présentant les membres de l\'équipe',
                'default_data' => null,
                'is_active' => true
            ],
            [
                'name' => 'Témoignages',
                'title' => 'Témoignages',
                'subtitle' => 'Ce que nos clients disent de nous',
                'type' => 'testimonial',
                'blade_component' => 'testimonial',
                'description' => 'Section présentant les témoignages de clients ou partenaires',
                'default_data' => null,
                'is_active' => true
            ],
            [
                'name' => 'Actualités',
                'title' => 'Nos Actualités',
                'subtitle' => 'Restez informé de nos dernières nouvelles',
                'type' => 'news',
                'blade_component' => 'new',
                'description' => 'Section présentant les dernières actualités',
                'default_data' => null,
                'is_active' => true
            ],
            [
                'name' => 'Galerie',
                'title' => 'Notre Galerie',
                'subtitle' => 'Découvrez nos photos',
                'type' => 'gallery',
                'blade_component' => 'gallery',
                'description' => 'Section présentant une galerie d\'images',
                'default_data' => null,
                'is_active' => true
            ],
            [
                'name' => 'Partenaires',
                'title' => 'Nos Partenaires',
                'subtitle' => 'Ils nous font confiance',
                'type' => 'partners',
                'blade_component' => 'partners',
                'description' => 'Section présentant les logos des partenaires',
                'default_data' => null,
                'is_active' => true
            ],
            [
                'name' => 'Bénévoles',
                'title' => 'Nos Bénévoles',
                'subtitle' => 'Rejoignez notre équipe de bénévoles',
                'type' => 'benevole',
                'blade_component' => 'benevole',
                'description' => 'Section pour recruter des bénévoles',
                'default_data' => null,
                'is_active' => true
            ],
            [
                'name' => 'Rapports',
                'title' => 'Nos Rapports',
                'subtitle' => 'Consultez nos rapports annuels et publications',
                'type' => 'reports',
                'blade_component' => 'reports',
                'description' => 'Section affichant une liste des rapports annuels et publications',
                'default_data' => [
                    'title' => 'Nos Rapports',
                    'subtitle' => 'Consultez nos rapports annuels et publications',
                    'description' => 'Téléchargez nos rapports d\'activités et financiers',
                    'show_thumbnails' => true,
                    'max_reports' => 6,
                ],
                'is_active' => true
            ],
            [
                'name' => 'Section Générique',
                'title' => 'Section Personnalisable',
                'subtitle' => 'Créez votre propre section',
                'type' => 'generic_section',
                'blade_component' => 'generic_section',
                'description' => 'Section entièrement personnalisable avec titre, texte, image et vidéo',
                'default_data' => [
                    'title' => 'Titre de la section',
                    'subtitle' => 'Sous-titre de la section',
                    'description' => 'Description de la section',
                    'button_text' => 'En savoir plus',
                    'button_url' => '#',
                    'background_color' => '#ffffff',
                    'text_color' => '#000000',
                ],
                'is_active' => true
            ],
        ];

        foreach ($sections as $section) {
            Section::updateOrCreate(
                ['name' => $section['name'], 'type' => $section['type']],
                $section
            );
        }
    }
}
