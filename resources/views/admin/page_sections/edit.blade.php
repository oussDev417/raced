@extends('admin.layouts.master')

@section('title', 'Modifier la section')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Modifier la section "{{ $pageSection->section->name }}" de la page "{{ $page->title }}"</h4>
                </div>
                <div>
                    <a href="{{ route('admin.page_sections.index', $page) }}" class="btn btn-primary">
                        <i class="fa fa-arrow-left me-2"></i>Retour aux sections
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

                <form action="{{ route('admin.page_sections.update', [$page, $pageSection]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Contenu de la section -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Contenu de la section</h5>
                                </div>
                                <div class="card-body">
                                    @php
                                        $sectionData = $pageSection->section_data ?? [];
                                        $sectionType = $pageSection->section->type ?? '';
                                    @endphp

                                    <!-- Champs communs pour toutes les sections -->
                                    <div class="form-group mb-3">
                                        <label for="title" class="form-label">Titre</label>
                                        <input type="text" class="form-control" id="title" name="section_data[title]" value="{{ $sectionData['title'] ?? $pageSection->section->title ?? '' }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="subtitle" class="form-label">Sous-titre</label>
                                        <input type="text" class="form-control" id="subtitle" name="section_data[subtitle]" value="{{ $sectionData['subtitle'] ?? $pageSection->section->subtitle ?? '' }}">
                                    </div>

                                    <!-- Champs spécifiques selon le type de section -->
                                    @switch($pageSection->section->blade_component)
                                        @case('slider')
                                            <div class="form-group mb-3">
                                                <label class="form-label">Paramètres du slider</label>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" id="autoplay" name="section_data[autoplay]" value="1" {{ isset($sectionData['autoplay']) && $sectionData['autoplay'] ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="autoplay">Lecture automatique</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" id="show_arrows" name="section_data[show_arrows]" value="1" {{ isset($sectionData['show_arrows']) && $sectionData['show_arrows'] ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="show_arrows">Afficher les flèches</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" id="show_dots" name="section_data[show_dots]" value="1" {{ isset($sectionData['show_dots']) && $sectionData['show_dots'] ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="show_dots">Afficher les points</label>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6">
                                                        <label for="slider_speed" class="form-label">Vitesse (ms)</label>
                                                        <input type="number" class="form-control" id="slider_speed" name="section_data[speed]" value="{{ $sectionData['speed'] ?? 5000 }}">
                                                    </div>
                                                </div>
                                            </div>
                                            @break
                                            
                                        @case('about')
                                            <div class="form-group mb-3">
                                                <label for="content" class="form-label">Contenu</label>
                                                <textarea class="form-control" id="content" name="section_data[content]" rows="5">{{ $sectionData['content'] ?? '' }}</textarea>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="image" class="form-label">Image (URL)</label>
                                                <input type="text" class="form-control" id="image" name="section_data[image]" value="{{ $sectionData['image'] ?? '' }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="button_text" class="form-label">Texte du bouton</label>
                                                <input type="text" class="form-control" id="button_text" name="section_data[button_text]" value="{{ $sectionData['button_text'] ?? '' }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="button_url" class="form-label">URL du bouton</label>
                                                <input type="text" class="form-control" id="button_url" name="section_data[button_url]" value="{{ $sectionData['button_url'] ?? '' }}">
                                            </div>
                                            @break
                                            
                                        @case('feature')
                                            <div class="form-group mb-3">
                                                <label for="content" class="form-label">Contenu</label>
                                                <textarea class="form-control" id="content" name="section_data[content]" rows="3">{{ $sectionData['content'] ?? '' }}</textarea>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Caractéristiques</label>
                                                <div id="features-container">
                                                    @if(isset($sectionData['features']) && is_array($sectionData['features']))
                                                        @foreach($sectionData['features'] as $index => $feature)
                                                            <div class="feature-item mb-3">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control" name="section_data[features][{{ $index }}][icon]" placeholder="Icône" value="{{ $feature['icon'] ?? '' }}">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control" name="section_data[features][{{ $index }}][title]" placeholder="Titre" value="{{ $feature['title'] ?? '' }}">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <textarea class="form-control" name="section_data[features][{{ $index }}][text]" placeholder="Description" rows="1">{{ $feature['text'] ?? '' }}</textarea>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <button type="button" class="btn btn-danger remove-feature"><i class="fa fa-trash"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <button type="button" id="add-feature" class="btn btn-info">
                                                    <i class="fa fa-plus-circle me-2"></i>Ajouter une caractéristique
                                                </button>
                                            </div>
                                            @break
                                            
                                        @case('custom_html')
                                            <div class="form-group mb-3">
                                                <label for="html_content" class="form-label">Contenu HTML</label>
                                                <textarea class="form-control" id="html_content" name="section_data[html]" rows="10">{{ $sectionData['html'] ?? '' }}</textarea>
                                                <small class="text-muted">Vous pouvez insérer du code HTML personnalisé ici.</small>
                                            </div>
                                            @break
                                            
                                        @case('generic_section')
                                            <div class="alert alert-info mb-3">
                                                <i class="fas fa-info-circle me-2"></i>
                                                Vous pouvez soit sélectionner une section générique existante, soit personnaliser directement les champs ci-dessous.
                                            </div>
                                            
                                            <div class="form-group mb-3">
                                                <label for="generic_section_id" class="form-label">Sélectionner une section générique</label>
                                                <select class="form-control" id="generic_section_id" name="section_data[generic_section_id]">
                                                    <option value="">-- Sélectionner une section --</option>
                                                    @if(isset($genericSections) && $genericSections->count() > 0)
                                                        @foreach($genericSections as $section)
                                                            <option value="{{ $section->id }}" {{ (isset($sectionData['generic_section_id']) && $sectionData['generic_section_id'] == $section->id) ? 'selected' : '' }}>
                                                                {{ $section->title }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <small class="text-muted">Si vous sélectionnez une section existante, ses paramètres seront utilisés à la place des valeurs ci-dessous.</small>
                                            </div>
                                            
                                            <hr>
                                            
                                            <h6 class="mb-3">Paramètres optionnels (si aucune section n'est sélectionnée)</h6>
                                            
                                            <div class="form-group mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" id="description" name="section_data[description]" rows="3">{{ $sectionData['description'] ?? '' }}</textarea>
                                            </div>
                                            
                                            <div class="form-group mb-3">
                                                <label for="image" class="form-label">Image (URL)</label>
                                                <input type="text" class="form-control" id="image" name="section_data[image]" value="{{ $sectionData['image'] ?? '' }}">
                                            </div>
                                            
                                            <div class="form-group mb-3">
                                                <label for="video_url" class="form-label">URL de la vidéo</label>
                                                <input type="url" class="form-control" id="video_url" name="section_data[video_url]" value="{{ $sectionData['video_url'] ?? '' }}">
                                                <small class="text-muted">Ex: https://www.youtube.com/watch?v=VIDEO_ID</small>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="button_text" class="form-label">Texte du bouton</label>
                                                    <input type="text" class="form-control" id="button_text" name="section_data[button_text]" value="{{ $sectionData['button_text'] ?? '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="button_url" class="form-label">URL du bouton</label>
                                                    <input type="text" class="form-control" id="button_url" name="section_data[button_url]" value="{{ $sectionData['button_url'] ?? '' }}">
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="background_color" class="form-label">Couleur de fond</label>
                                                    <input type="color" class="form-control form-control-color" id="background_color" name="section_data[background_color]" value="{{ $sectionData['background_color'] ?? '#ffffff' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="text_color" class="form-label">Couleur du texte</label>
                                                    <input type="color" class="form-control form-control-color" id="text_color" name="section_data[text_color]" value="{{ $sectionData['text_color'] ?? '#000000' }}">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group mb-3">
                                                <label for="image_position" class="form-label">Position de l'image</label>
                                                <select class="form-control" id="image_position" name="section_data[image_position]">
                                                    <option value="right" {{ (isset($sectionData['image_position']) && $sectionData['image_position'] == 'right') ? 'selected' : '' }}>Droite</option>
                                                    <option value="left" {{ (isset($sectionData['image_position']) && $sectionData['image_position'] == 'left') ? 'selected' : '' }}>Gauche</option>
                                                </select>
                                            </div>
                                            @break
                                            
                                        @case('reports')
                                            <div class="form-group mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" id="description" name="section_data[description]" rows="3">{{ $sectionData['description'] ?? '' }}</textarea>
                                            </div>
                                            
                                            <div class="form-group mb-3">
                                                <label for="max_reports" class="form-label">Nombre maximum de rapports à afficher</label>
                                                <input type="number" class="form-control" id="max_reports" name="section_data[max_reports]" value="{{ $sectionData['max_reports'] ?? 6 }}" min="1" max="12">
                                            </div>
                                            
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="show_thumbnails" name="section_data[show_thumbnails]" value="1" {{ isset($sectionData['show_thumbnails']) && $sectionData['show_thumbnails'] ? 'checked' : '' }}>
                                                <label class="form-check-label" for="show_thumbnails">Afficher les miniatures</label>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="button_text" class="form-label">Texte du bouton (optionnel)</label>
                                                    <input type="text" class="form-control" id="button_text" name="section_data[button_text]" value="{{ $sectionData['button_text'] ?? '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="button_url" class="form-label">URL du bouton</label>
                                                    <input type="text" class="form-control" id="button_url" name="section_data[button_url]" value="{{ $sectionData['button_url'] ?? '' }}">
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="background_color" class="form-label">Couleur de fond</label>
                                                    <input type="color" class="form-control form-control-color" id="background_color" name="section_data[background_color]" value="{{ $sectionData['background_color'] ?? '#ffffff' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="text_color" class="form-label">Couleur du texte</label>
                                                    <input type="color" class="form-control form-control-color" id="text_color" name="section_data[text_color]" value="{{ $sectionData['text_color'] ?? '#000000' }}">
                                                </div>
                                            </div>
                                            @break
                                            
                                        @default
                                            <div class="alert alert-info">
                                                <p>Les champs spécifiques pour ce type de section ({{ $pageSection->section->blade_component }}) ne sont pas encore disponibles dans l'interface d'administration.</p>
                                                <p>Vous pouvez toujours modifier les champs communs (titre, sous-titre, etc.).</p>
                                            </div>
                                    @endswitch

                                    <!-- JSON avancé pour les utilisateurs expérimentés -->
                                    <div class="form-group mb-3">
                                        <label for="advanced_json" class="form-label">Configuration avancée (JSON)</label>
                                        <textarea class="form-control" id="advanced_json" name="advanced_json" rows="5">{{ json_encode($pageSection->section_data, JSON_PRETTY_PRINT) }}</textarea>
                                        <small class="text-muted">Pour les utilisateurs avancés seulement. Modifiez ce JSON uniquement si vous savez ce que vous faites.</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Paramètres de la section -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Paramètres</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="custom_class" class="form-label">Classes CSS personnalisées</label>
                                        <input type="text" class="form-control" id="custom_class" name="custom_class" value="{{ $pageSection->custom_class }}">
                                        <small class="text-muted">Ajoutez des classes CSS pour personnaliser l'apparence de cette section.</small>
                                    </div>

                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ $pageSection->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Section active</label>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Informations sur le type de section -->
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title">Informations</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Type de section :</strong> {{ $pageSection->section->name }}</p>
                                    <p><strong>Composant :</strong> {{ $pageSection->section->blade_component }}</p>
                                    <p><strong>Ordre :</strong> {{ $pageSection->order }}</p>
                                    <p><strong>Description :</strong></p>
                                    <p>{{ $pageSection->section->description ?? 'Aucune description disponible.' }}</p>
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
    // Initialiser l'éditeur WYSIWYG si disponible
    if (typeof ClassicEditor !== 'undefined') {
        const editorFields = ['#content', '#description'];
        
        editorFields.forEach(selector => {
            const element = document.querySelector(selector);
            if (element) {
                ClassicEditor
                    .create(element)
                    .catch(error => {
                        console.error('Erreur lors de l\'initialisation de l\'éditeur :', error);
                    });
            }
        });
    }

    // Validation et mise à jour du JSON avancé
    document.getElementById('advanced_json').addEventListener('blur', function() {
        try {
            const json = JSON.parse(this.value);
            this.value = JSON.stringify(json, null, 2);
            this.classList.remove('is-invalid');
        } catch (e) {
            this.classList.add('is-invalid');
            alert('Le JSON n\'est pas valide : ' + e.message);
        }
    });

    // Gestion des caractéristiques pour les sections de type "feature"
    let featureCount = {{ isset($sectionData['features']) && is_array($sectionData['features']) ? count($sectionData['features']) : 0 }};
    
    $('#add-feature').click(function() {
        const newFeature = `
            <div class="feature-item mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="section_data[features][${featureCount}][icon]" placeholder="Icône">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="section_data[features][${featureCount}][title]" placeholder="Titre">
                    </div>
                    <div class="col-md-3">
                        <textarea class="form-control" name="section_data[features][${featureCount}][text]" placeholder="Description" rows="1"></textarea>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger remove-feature"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>
        `;
        
        $('#features-container').append(newFeature);
        featureCount++;
    });
    
    // Supprimer une caractéristique
    $(document).on('click', '.remove-feature', function() {
        $(this).closest('.feature-item').remove();
    });
</script>
@endpush 