@extends('admin.layouts.master')

@section('title', 'Modifier le type de section')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Modifier le type de section : {{ $section->name }}</h4>
                </div>
                <div>
                    <a href="{{ route('admin.sections.index') }}" class="btn btn-primary">
                        <i class="fa fa-arrow-left me-2"></i>Retour à la liste
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.sections.update', $section) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Informations générales -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Informations générales</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $section->name) }}" required>
                                        <small class="text-muted">Nom convivial pour ce type de section (ex: Slider d'en-tête, À propos, etc.)</small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="type" class="form-label">Identifiant technique <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="type" name="type" value="{{ old('type', $section->type) }}" required>
                                        <small class="text-muted">Identifiant technique unique (ex: header_slider, about_section, etc.)</small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="blade_component" class="form-label">Composant Blade <span class="text-danger">*</span></label>
                                        <select class="form-control" id="blade_component" name="blade_component" required>
                                            <option value="">Sélectionner un composant</option>
                                            @foreach($bladeComponents as $value => $label)
                                                <option value="{{ $value }}" {{ old('blade_component', $section->blade_component) == $value ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted">Composant Blade qui sera utilisé pour afficher cette section</small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $section->description) }}</textarea>
                                        <small class="text-muted">Description de cette section pour aider les utilisateurs</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Contenu par défaut -->
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title">Contenu par défaut</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="title" class="form-label">Titre par défaut</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $section->title) }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="subtitle" class="form-label">Sous-titre par défaut</label>
                                        <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ old('subtitle', $section->subtitle) }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="default_data" class="form-label">Données par défaut (JSON)</label>
                                        <textarea class="form-control" id="default_data" name="default_data" rows="5">{{ old('default_data', json_encode($section->default_data ?? (object)[], JSON_PRETTY_PRINT)) }}</textarea>
                                        <small class="text-muted">Données par défaut pour ce type de section au format JSON</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Paramètres -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Paramètres</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $section->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Section active</label>
                                    </div>

                                    <div class="d-grid gap-2 mt-4">
                                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Informations supplémentaires -->
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title">Informations</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Créé le :</strong> {{ $section->created_at->format('d/m/Y à H:i') }}</p>
                                    <p><strong>Dernière modification :</strong> {{ $section->updated_at->format('d/m/Y à H:i') }}</p>
                                    <p><strong>Utilisations :</strong> {{ $section->pageSections()->count() }} page(s)</p>
                                    
                                    @if($section->pageSections()->count() > 0)
                                        <div class="alert alert-info mt-3">
                                            <i class="fa fa-info-circle me-2"></i> Ce type de section est utilisé sur des pages. Les modifications affecteront toutes les pages qui l'utilisent.
                                        </div>
                                    @endif
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

@push('scripts')
<script>
    // Validation du JSON
    document.getElementById('default_data').addEventListener('blur', function() {
        try {
            const json = JSON.parse(this.value);
            this.value = JSON.stringify(json, null, 2);
            this.classList.remove('is-invalid');
        } catch (e) {
            this.classList.add('is-invalid');
            alert('Le JSON n\'est pas valide : ' + e.message);
        }
    });
</script>
@endpush 