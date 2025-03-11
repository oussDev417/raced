<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            
            // Redimensionner et sauvegarder l'image
            $manager = new ImageManager(new Driver());
            $manager->read($image)
                ->cover(800, 600)
                ->save(public_path('storage/projects/' . $filename));
            
            $data['image'] = 'storage/projects/' . $filename;
        }
        
        Project::create($data);
        
        return redirect()->route('admin.projects.index')->with('success', 'Projet créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($project->image) {
                $oldPath = str_replace('storage/', 'public/', $project->image);
                Storage::delete($oldPath);
            }
            
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            
            // Redimensionner et sauvegarder l'image
            $manager = new ImageManager(new Driver());
            $manager->read($image)
                ->cover(800, 600)
                ->save(public_path('storage/projects/' . $filename));
            
            $data['image'] = 'storage/projects/' . $filename;
        }
        
        $project->update($data);
        
        return redirect()->route('admin.projects.index')->with('success', 'Projet mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Supprimer l'image associée
        if ($project->image) {
            $path = str_replace('storage/', 'public/', $project->image);
            Storage::delete($path);
        }
        
        $project->delete();
        
        return redirect()->route('admin.projects.index')->with('success', 'Projet supprimé avec succès');
    }

    /**
     * Update the order of projects.
     */
    public function updateOrder(Request $request)
    {
        $order = $request->input('order', []);
        
        foreach ($order as $position => $id) {
            Project::where('id', $id)->update(['position' => $position]);
        }
        
        return response()->json(['success' => true]);
    }
}
