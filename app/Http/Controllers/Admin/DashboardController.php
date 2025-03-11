<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Benevole;
use App\Models\Contact;
use App\Models\News;
use App\Models\Project;
use App\Models\Galerie;

class DashboardController extends Controller
{
    /**
     * Affiche le tableau de bord avec les statistiques
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupération des statistiques
        $stats = [
            'users' => User::count(),
            'benevoles' => Benevole::count(),
            'messages' => Contact::count(),
            'news' => News::count(),
            'projects' => Project::count(),
            'galeries' => Galerie::count(),
            'recent_messages' => Contact::latest()->take(5)->get(),
            'recent_benevoles' => Benevole::latest()->take(5)->get(),
            'recent_news' => News::latest()->take(5)->get(),
        ];
        
        return view('admin.dashboard.index', compact('stats'));
    }
}
