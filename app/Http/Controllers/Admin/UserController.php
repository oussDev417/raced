<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Redimensionner et sauvegarder l'image avec Intervention Image v3
            $manager = new ImageManager(new Driver());
            $manager->read($image)
                ->cover(800, 800)
                ->save(public_path('storage/users/' . $imageName));
            
            $data['image'] = $imageName;
        }
        
        $data['password'] = Hash::make($data['password']);
        
        User::create($data);
        
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès');
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
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($user->image && Storage::exists('public/users/' . $user->image)) {
                Storage::delete('public/users/' . $user->image);
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Redimensionner et sauvegarder l'image avec Intervention Image v3
            $manager = new ImageManager(new Driver());
            $manager->read($image)
                ->cover(800, 800)
                ->save(public_path('storage/users/' . $imageName));
            
            $data['image'] = $imageName;
        }
        
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        
        $user->update($data);
        
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Supprimer l'image associée
        if ($user->image && Storage::exists('public/users/' . $user->image)) {
            Storage::delete('public/users/' . $user->image);
        }
        
        $user->delete();
        
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès');
    }
}
