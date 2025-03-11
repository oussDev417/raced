<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Equipe;
use App\Models\EquipeCategory;
use App\Models\Partner;
use App\Models\Setting;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $categories = EquipeCategory::all();
        $equipes = Equipe::all();
        $equipeCategories = EquipeCategory::with('equipes')->get();
        $partners = Partner::latest()->get();
        $settings = Setting::first();
        return view('frontend.team.index', compact('categories', 'equipes', 'equipeCategories', 'partners', 'settings'));
    }
}
