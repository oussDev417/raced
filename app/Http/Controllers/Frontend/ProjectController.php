<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Project;
use App\Models\Partner;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Affiche la liste des projets avec pagination.
     */
    public function index()
    {
        // Récupérer les paramètres d'en-tête et de pied de page
        $settings = Setting::first();

        // Récupérer les projets avec pagination (9 par page)
        $projects = Project::latest()->paginate(9);
        $partners = Partner::latest()->get();

        // Récupérer les projets récents pour la sidebar
        $recentProjects = Project::latest()->take(5)->get();

        return view('frontend.projects.index', compact(
            'settings',
            'projects',
            'partners',
            'recentProjects'
        ));
    }

    /**
     * Affiche les détails d'un projet spécifique.
     */
    public function show($slug)
    {
        // Récupérer les paramètres d'en-tête et de pied de page
        $settings = Setting::first();

        // Récupérer le projet
        $project = Project::where('slug', $slug)->firstOrFail();

        // Récupérer les projets récents pour la sidebar (excluant le projet courant)
        $recentProjects = Project::where('id', '!=', $project->id)
            ->latest()
            ->take(5)
            ->get();

        // Récupérer les projets reliés (excluant le projet courant)
        $relatedProjects = Project::where('id', '!=', $project->id)
            ->latest()
            ->take(3)
            ->get();


        $partners = Partner::latest()->get();
        
        return view('frontend.projects.show', compact(
            'settings',
            'project',
            'recentProjects',
            'relatedProjects',
            'partners'
        ));
    }

    /**
     * Affiche la pagination des projets.
     */
    public function paginate(Request $request)
    {
        $projects = Project::latest()->paginate(9);
        return view('frontend.projects._pagination', compact('projects'));
    }
}
