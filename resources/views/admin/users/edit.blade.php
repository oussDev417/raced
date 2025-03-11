@extends('admin.layouts.master')

@section('title', 'Modifier un utilisateur')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Utilisateurs</a></li>
        <li class="breadcrumb-item active" aria-current="page">Modifier</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @include('admin.layouts.alerts')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Modifier l'utilisateur</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-8">
                        <!-- Informations de base -->
                        <div class="mb-4">
                            <h6 class="card-subtitle text-muted mb-3">Informations de base</h6>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nom complet" value="{{ old('name', $user->name) }}" required>
                                        <label for="name">Nom complet</label>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Nom d'utilisateur" value="{{ old('username', $user->username) }}" required>
                                        <label for="username">Nom d'utilisateur</label>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ old('email', $user->email) }}" required>
                                        <label for="email">Email</label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Téléphone" value="{{ old('phone', $user->phone) }}">
                                        <label for="phone">Téléphone</label>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Mot de passe -->
                        <div class="mb-4">
                            <h6 class="card-subtitle text-muted mb-3">Mot de passe</h6>
                            <p class="text-muted small mb-3">Laissez vide si vous ne souhaitez pas modifier le mot de passe</p>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Nouveau mot de passe">
                                        <label for="password">Nouveau mot de passe</label>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmer le nouveau mot de passe">
                                        <label for="password_confirmation">Confirmer le nouveau mot de passe</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <!-- Avatar -->
                        <div class="mb-4">
                            <h6 class="card-subtitle text-muted mb-3">Avatar</h6>
                            
                            <div class="text-center mb-3">
                                <img src="{{ $user->image ? asset('storage/users/' . $user->image) : asset('assets/images/default-avatar.png') }}" 
                                     alt="Avatar" class="rounded-circle img-fluid mb-2" width="150" height="150" id="avatar-preview">
                            </div>
                            
                            <div class="custom-file-upload">
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" data-preview="#avatar-preview">
                                <small class="form-text text-muted">Format accepté : JPG, PNG. Taille max : 2MB</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary me-2">Annuler</a>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    #avatar-preview {
        object-fit: cover;
        border: 2px solid #eee;
    }
    
    .custom-file-upload {
        text-align: center;
    }
</style>
@endsection

@section('scripts')
<script>
    // Prévisualisation de l'image
    document.getElementById('image').addEventListener('change', function(e) {
        const preview = document.getElementById('avatar-preview');
        const file = e.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
    
    // Validation du formulaire
    (function () {
        'use strict'
        
        const forms = document.querySelectorAll('.needs-validation');
        
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
@endsection 