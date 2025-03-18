<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Emplacements des menus
    |--------------------------------------------------------------------------
    |
    | Cette configuration définit les emplacements disponibles pour les menus
    | dans l'application. Vous pouvez ajouter des emplacements personnalisés
    | selon les besoins de votre thème.
    |
    */
    'locations' => [
        'header' => 'En-tête',
        'footer' => 'Pied de page',
        'sidebar' => 'Barre latérale',
        'mobile' => 'Menu mobile',
    ],

    /*
    |--------------------------------------------------------------------------
    | Profondeur maximale des menus
    |--------------------------------------------------------------------------
    |
    | Définit la profondeur maximale des sous-menus dans le constructeur de menu.
    | Une valeur de 0 désactive les sous-menus, 1 permet un niveau, etc.
    |
    */
    'max_depth' => 3,

    /*
    |--------------------------------------------------------------------------
    | Icônes par défaut
    |--------------------------------------------------------------------------
    |
    | Définit les icônes par défaut pour certains types d'éléments de menu.
    | Ces icônes seront utilisées si aucune icône n'est spécifiée.
    |
    */
    'default_icons' => [
        'home' => 'fa fa-home',
        'page' => 'fa fa-file',
        'external' => 'fa fa-external-link-alt',
        'submenu' => 'fa fa-chevron-down',
    ],
]; 