@extends('admin.layouts.master')

@section('title', 'Créer un nouveau menu')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Créer un nouveau menu</h4>
                </div>
                <div>
                    <a href="{{ route('admin.menus.index') }}" class="btn btn-primary">
                        <i class="fa fa-arrow-left me-2"></i>Retour à la liste
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.menus.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Nom du menu <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                <small class="text-muted">Le nom qui sera affiché dans l'administration.</small>
                            </div>

                            <div class="form-group mb-3">
                                <label for="location" class="form-label">Emplacement <span class="text-danger">*</span></label>
                                <select class="form-control" id="location" name="location" required>
                                    <option value="">Sélectionner un emplacement</option>
                                    @foreach($locations as $key => $location)
                                        <option value="{{ $key }}" {{ old('location') == $key ? 'selected' : '' }}>{{ $location }}</option>
                                    @endforeach
                                </select>
                                <small class="text-muted">L'emplacement où ce menu sera affiché sur le site.</small>
                            </div>

                            <div class="form-group mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                <small class="text-muted">Une description pour vous aider à identifier ce menu (optionnelle).</small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Paramètres</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Menu actif</label>
                                    </div>

                                    <div class="form-group">
                                        <label for="class" class="form-label">Classe CSS</label>
                                        <input type="text" class="form-control" id="class" name="class" value="{{ old('class') }}">
                                        <small class="text-muted">Classes CSS à appliquer au menu (optionnel).</small>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-4">
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">Créer le menu</button>
                                        <a href="{{ route('admin.menus.index') }}" class="btn btn-outline-secondary">Annuler</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 