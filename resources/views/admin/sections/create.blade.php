@extends('admin.layouts.master')

@section('title', 'Ajouter un type de section')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Créer un nouveau type de section</h4>
                </div>
                <div>
                    <a href="{{ route('admin.sections.index') }}" class="btn btn-primary">
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

                <form action="{{ route('admin.sections.store') }}" method="POST">
                    @csrf
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
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                        <small class="text-muted">Nom convivial pour ce type de section (ex: Slider d'en-tête, À propos, etc.)</small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="type" class="form-label">Identifiant technique <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="type" name="type" value="{{ old('type') }}" required>
                                        <small class="text-muted">Identifiant technique unique (ex: header_slider, about_section, etc.)</small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="blade_component" class="form-label">Composant Blade <span class="text-danger">*</span></label>
                                        <select class="form-control" id="blade_component" name="blade_component" required>
                                            <option value="">Sélectionner un composant</option>
                                            @foreach($bladeComponents as $value => $label)
                                                <option value="{{ $value }}" {{ old('blade_component') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted">Composant Blade qui sera utilisé pour afficher cette section</small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
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
                                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="subtitle" class="form-label">Sous-titre par défaut</label>
                                        <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ old('subtitle') }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="default_data" class="form-label">Données par défaut (JSON)</label>
                                        <textarea class="form-control" id="default_data" name="default_data" rows="5">{{ old('default_data', '{}') }}</textarea>
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
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Section active</label>
                                    </div>

                                    <div class="d-grid gap-2 mt-4">
                                        <button type="submit" class="btn btn-primary">Créer le type de section</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Aide -->
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title">Aide</h5>
                                </div>
                                <div class="card-body">
                                    <p>Les types de sections définissent les différentes parties qui peuvent être ajoutées aux pages.</p>
                                    <p>Chaque type de section est lié à un composant Blade qui définit son apparence et son comportement.</p>
                                    <p>Vous pouvez définir des valeurs par défaut pour chaque type de section.</p>
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
    // Générer automatiquement l'identifiant technique à partir du nom
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value;
        const type = name.toLowerCase()
            .replace(/[^\w\s-]/g, '') // Supprimer les caractères spéciaux
            .replace(/\s+/g, '_') // Remplacer les espaces par des tirets bas
            .replace(/__+/g, '_') // Éviter les tirets bas multiples
            .trim(); // Supprimer les espaces au début et à la fin
        
        document.getElementById('type').value = type;
    });

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