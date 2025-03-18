<!-- GENERIC SECTION START -->
<section class="ul-generic-section ul-section-spacing wow animate__fadeInUp {{ $customClass ?? '' }}"
        @if(isset($data['background_color']) && $data['background_color']) style="background-color: {{ $data['background_color'] }};" @endif>
    <div class="ul-container">
        @php
            // Récupération de la section générique associée (si elle existe)
            $genericSection = null;
            if (isset($data['generic_section_id']) && $data['generic_section_id']) {
                $genericSection = \App\Models\GenericSection::where('id', $data['generic_section_id'])
                    ->where('active', true)
                    ->first();
            }
            
            // Définition des variables à utiliser avec le bon ordre de priorité
            // D'abord la section générique si elle existe, puis les données spécifiques de la page
            if ($genericSection) {
                // Si une section générique est sélectionnée, utiliser ses données en priorité
                $sectionTitle = $genericSection->title ?? $data['title'] ?? $title ?? null;
                $sectionSubtitle = $genericSection->subtitle ?? $data['subtitle'] ?? $subtitle ?? null;
                $sectionDescription = $genericSection->description ?? $data['description'] ?? null;
                $sectionImage = $genericSection->image ?? $data['image'] ?? null;
                $sectionVideoUrl = $genericSection->video_url ?? $data['video_url'] ?? null;
                $sectionButtonText = $genericSection->button_text ?? $data['button_text'] ?? null;
                $sectionButtonUrl = $genericSection->button_url ?? $data['button_url'] ?? null;
                $sectionTextColor = $genericSection->text_color ?? $data['text_color'] ?? '#000000';
                $sectionBackgroundColor = $genericSection->background_color ?? $data['background_color'] ?? '#ffffff';
            } else {
                // Sinon utiliser les données de la section de page
                $sectionTitle = $title ?? $data['title'] ?? null;
                $sectionSubtitle = $subtitle ?? $data['subtitle'] ?? null;
                $sectionDescription = $data['description'] ?? null;
                $sectionImage = $data['image'] ?? null;
                $sectionVideoUrl = $data['video_url'] ?? null;
                $sectionButtonText = $data['button_text'] ?? null;
                $sectionButtonUrl = $data['button_url'] ?? null;
                $sectionTextColor = $data['text_color'] ?? '#000000';
                $sectionBackgroundColor = $data['background_color'] ?? '#ffffff';
            }
            
            // Déterminer la disposition (image à gauche ou à droite)
            $imagePosition = $data['image_position'] ?? 'right';
        @endphp

        <section style="background-color: {{ $sectionBackgroundColor }};">
            <div class="row align-items-center gy-5 {{ $imagePosition == 'left' ? 'flex-row-reverse' : '' }}">
                <div class="col-lg-6 col-md-12">
                    <div class="ul-generic-section-content">
                        @if($sectionSubtitle)
                            <span class="ul-section-sub-title ul-section-sub-title--2"
                                @if($sectionTextColor) style="color: {{ $sectionTextColor }};" @endif>
                                {{ $sectionSubtitle }}
                            </span>
                        @endif
                        
                        @if($sectionTitle)
                            <h2 class="ul-section-title"
                                @if($sectionTextColor) style="color: {{ $sectionTextColor }};" @endif>
                                {{ $sectionTitle }}
                            </h2>
                        @endif
                        
                        @if($sectionDescription)
                            <div class="ul-section-descr"
                                @if($sectionTextColor) style="color: {{ $sectionTextColor }};" @endif>
                                {!! $sectionDescription !!}
                            </div>
                        @endif
                        
                        @if($sectionButtonText && $sectionButtonUrl)
                            <div class="mt-4">
                                <a href="{{ $sectionButtonUrl }}" class="ul-btn">
                                    <i class="flaticon-fast-forward-double-right-arrows-symbol"></i> {{ $sectionButtonText }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-12">
                    <div class="ul-generic-section-media">
                        @if($sectionVideoUrl)
                            <div class="ul-video-wrapper">
                                @php
                                    // Extraction de l'ID de la vidéo YouTube
                                    $videoId = null;
                                    if (preg_match('/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $sectionVideoUrl, $matches)) {
                                        $videoId = $matches[1];
                                    }
                                @endphp
                                
                                @if($videoId)
                                    <div class="ratio ratio-16x9">
                                        <iframe src="https://www.youtube.com/embed/{{ $videoId }}" 
                                                title="YouTube video" 
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                allowfullscreen>
                                        </iframe>
                                    </div>
                                @else
                                    <div class="ratio ratio-16x9">
                                        <iframe src="{{ $sectionVideoUrl }}" 
                                                title="Video" 
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                allowfullscreen>
                                        </iframe>
                                    </div>
                                @endif
                            </div>
                        @elseif($sectionImage)
                            <div class="ul-generic-section-img">
                                <img src="{{ asset('storage/' . $sectionImage) }}" alt="{{ $sectionTitle }}" class="img-fluid rounded">
                            </div>
                        @else
                            <div class="ul-generic-section-placeholder">
                                <div class="placeholder-text text-center">
                                    <i class="fas fa-image fa-3x mb-3"></i>
                                    <p>Aucun média disponible</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
<!-- GENERIC SECTION END --> 