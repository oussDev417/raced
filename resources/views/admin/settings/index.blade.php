@extends('admin.layouts.master')

@section('title', 'Paramètres du Site')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Paramètres du Site</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Paramètres du Site</h5>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="settingsTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active text-dark" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">
                        <i class="fas fa-cog me-1"></i>Général
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-dark border" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">
                        <i class="fas fa-address-book me-1"></i>Contact
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-dark border" id="social-tab" data-bs-toggle="tab" data-bs-target="#social" type="button" role="tab" aria-controls="social" aria-selected="false">
                        <i class="fas fa-share-alt me-1"></i>Réseaux Sociaux
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-dark border" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo" type="button" role="tab" aria-controls="seo" aria-selected="false">
                        <i class="fas fa-search me-1"></i>SEO
                    </button>
                </li>
            </ul>
            
            <form action="{{ route('admin.settings.update', $settings->id ?? 1) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="tab-content p-3 border border-top-0 rounded-bottom" id="settingsTabsContent">
                    <!-- Onglet Général -->
                    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="site_name" class="form-label">Nom du site <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('site_name') is-invalid @enderror" id="site_name" name="site_name" value="{{ old('site_name', $settings->site_name ?? '') }}" required>
                                    @error('site_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="site_slogan" class="form-label">Slogan du site</label>
                                    <input type="text" class="form-control @error('site_slogan') is-invalid @enderror" id="site_slogan" name="site_slogan" value="{{ old('site_slogan', $settings->site_slogan ?? '') }}">
                                    @error('site_slogan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="logo" class="form-label">Logo du site</label>
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*">
                                    @error('logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Format recommandé : PNG transparent, max 2 Mo</small>
                                    
                                    @if(isset($settings->logo) && $settings->logo)
                                        <div class="mt-2">
                                            <p>Logo actuel :</p>
                                            <img src="{{ asset($settings->logo) }}" alt="Logo du site" class="img-thumbnail" style="max-height: 100px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="favicon" class="form-label">Favicon</label>
                                    <input type="file" class="form-control @error('favicon') is-invalid @enderror" id="favicon" name="favicon" accept="image/x-icon,image/png">
                                    @error('favicon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Format recommandé : ICO ou PNG, 16x16 ou 32x32 pixels</small>
                                    
                                    @if(isset($settings->favicon) && $settings->favicon)
                                        <div class="mt-2">
                                            <p>Favicon actuel :</p>
                                            <img src="{{ asset($settings->favicon) }}" alt="Favicon" class="img-thumbnail" style="max-height: 32px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="footer_text" class="form-label">Texte de pied de page</label>
                                    <textarea class="form-control @error('footer_text') is-invalid @enderror" id="footer_text" name="footer_text" rows="2">{{ old('footer_text', $settings->footer_text ?? '') }}</textarea>
                                    @error('footer_text')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Texte affiché dans le pied de page du site (copyright, etc.)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Onglet Contact -->
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact_email" class="form-label">Email de contact</label>
                                    <input type="email" class="form-control @error('contact_email') is-invalid @enderror" id="contact_email" name="contact_email" value="{{ old('contact_email', $settings->contact_email ?? '') }}">
                                    @error('contact_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact_phone" class="form-label">Téléphone</label>
                                    <input type="text" class="form-control @error('contact_phone') is-invalid @enderror" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $settings->contact_phone ?? '') }}">
                                    @error('contact_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="bank_number" class="form-label">Numéro bancaire</label>
                                    <input type="text" class="form-control @error('bank_number') is-invalid @enderror" id="bank_number" name="bank_number" value="{{ old('bank_number', $settings->bank_number ?? '') }}">
                                    @error('bank_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="contact_address" class="form-label">Adresse</label>
                                    <textarea class="form-control @error('contact_address') is-invalid @enderror" id="contact_address" name="contact_address" rows="3">{{ old('contact_address', $settings->contact_address ?? '') }}</textarea>
                                    @error('contact_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="google_maps" class="form-label">Lien Google Maps</label>
                                    <input type="text" class="form-control @error('google_maps') is-invalid @enderror" id="google_maps" name="google_maps" value="{{ old('google_maps', $settings->google_maps ?? '') }}">
                                    @error('google_maps')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">URL d'intégration Google Maps (iframe src)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact_hours" class="form-label">Heures d'ouverture</label>
                                    <textarea class="form-control @error('contact_hours') is-invalid @enderror" id="contact_hours" name="contact_hours" rows="3">{{ old('contact_hours', $settings->contact_hours ?? '') }}</textarea>
                                    @error('contact_hours')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Onglet Réseaux Sociaux -->
                    <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="facebook_url" class="form-label">
                                        <i class="fab fa-facebook text-primary me-1"></i>Facebook
                                    </label>
                                    <input type="url" class="form-control @error('facebook_url') is-invalid @enderror" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $settings->facebook_url ?? '') }}">
                                    @error('facebook_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="twitter_url" class="form-label">
                                        <i class="fab fa-twitter text-info me-1"></i>Twitter
                                    </label>
                                    <input type="url" class="form-control @error('twitter_url') is-invalid @enderror" id="twitter_url" name="twitter_url" value="{{ old('twitter_url', $settings->twitter_url ?? '') }}">
                                    @error('twitter_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="instagram_url" class="form-label">
                                        <i class="fab fa-instagram text-danger me-1"></i>Instagram
                                    </label>
                                    <input type="url" class="form-control @error('instagram_url') is-invalid @enderror" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $settings->instagram_url ?? '') }}">
                                    @error('instagram_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="linkedin_url" class="form-label">
                                        <i class="fab fa-linkedin text-primary me-1"></i>LinkedIn
                                    </label>
                                    <input type="url" class="form-control @error('linkedin_url') is-invalid @enderror" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url', $settings->linkedin_url ?? '') }}">
                                    @error('linkedin_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="youtube_url" class="form-label">
                                        <i class="fab fa-youtube text-danger me-1"></i>YouTube
                                    </label>
                                    <input type="url" class="form-control @error('youtube_url') is-invalid @enderror" id="youtube_url" name="youtube_url" value="{{ old('youtube_url', $settings->youtube_url ?? '') }}">
                                    @error('youtube_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="whatsapp_number" class="form-label">
                                        <i class="fab fa-whatsapp text-success me-1"></i>WhatsApp
                                    </label>
                                    <input type="text" class="form-control @error('whatsapp_number') is-invalid @enderror" id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number', $settings->whatsapp_number ?? '') }}">
                                    @error('whatsapp_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Format international (ex: +33612345678)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Onglet SEO -->
                    <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="meta_title" class="form-label">Titre Meta (SEO)</label>
                                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" name="meta_title" value="{{ old('meta_title', $settings->meta_title ?? '') }}">
                                    @error('meta_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Titre utilisé pour le référencement (60-70 caractères max)</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="meta_description" class="form-label">Description Meta</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $settings->meta_description ?? '') }}</textarea>
                                    @error('meta_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Description utilisée pour le référencement (150-160 caractères max)</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="meta_keywords" class="form-label">Mots-clés Meta</label>
                                    <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $settings->meta_keywords ?? '') }}">
                                    @error('meta_keywords')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Mots-clés séparés par des virgules</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="google_analytics" class="form-label">Code Google Analytics</label>
                                    <textarea class="form-control @error('google_analytics') is-invalid @enderror" id="google_analytics" name="google_analytics" rows="5">{{ old('google_analytics', $settings->google_analytics ?? '') }}</textarea>
                                    @error('google_analytics')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Code de suivi Google Analytics (script complet)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Enregistrer les paramètres
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Conserver l'onglet actif après soumission du formulaire en cas d'erreur
    const activeTab = localStorage.getItem('activeSettingsTab');
    if (activeTab && document.querySelector(activeTab)) {
        const tabEl = document.querySelector(activeTab);
        const tab = new bootstrap.Tab(tabEl);
        tab.show();
    }
    
    // Enregistrer l'onglet actif lors du changement
    const tabs = document.querySelectorAll('button[data-bs-toggle="tab"]');
    tabs.forEach(tab => {
        tab.addEventListener('shown.bs.tab', function(event) {
            localStorage.setItem('activeSettingsTab', '#' + event.target.id);
        });
    });
    
    // Prévisualisation des images
    const logoInput = document.getElementById('logo');
    const faviconInput = document.getElementById('favicon');
    
    if (logoInput) {
        logoInput.addEventListener('change', function() {
            previewImage(this, 'logo-preview');
        });
    }
    
    if (faviconInput) {
        faviconInput.addEventListener('change', function() {
            previewImage(this, 'favicon-preview');
        });
    }
    
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (!preview) {
            const container = input.parentElement;
            const previewDiv = document.createElement('div');
            previewDiv.className = 'mt-2';
            previewDiv.innerHTML = `
                <p>Aperçu :</p>
                <img id="${previewId}" src="#" alt="Aperçu" class="img-thumbnail" style="max-height: 100px;">
            `;
            container.appendChild(previewDiv);
        }
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById(previewId) || document.createElement('img');
                preview.src = e.target.result;
                if (!document.getElementById(previewId)) {
                    preview.id = previewId;
                    preview.className = 'img-thumbnail';
                    preview.style.maxHeight = previewId === 'favicon-preview' ? '32px' : '100px';
                    const container = input.parentElement;
                    container.appendChild(preview);
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
});
</script>
@endsection 