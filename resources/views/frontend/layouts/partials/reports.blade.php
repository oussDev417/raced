<!-- REPORTS SECTION START -->
<section class="ul-reports ul-section-spacing wow animate__fadeInUp {{ $customClass ?? '' }}"
        @if(isset($data['background_color']) && $data['background_color']) style="background-color: {{ $data['background_color'] }};" @endif>
    <div class="ul-container">
        <div class="ul-section-header text-center">
            <span class="ul-section-sub-title ul-section-sub-title--2">{{ $subtitle ?? $data['subtitle'] ?? 'Publications' }}</span>
            <h2 class="ul-section-title"
                @if(isset($data['text_color']) && $data['text_color']) style="color: {{ $data['text_color'] }};" @endif>
                {{ $title ?? $data['title'] ?? 'Nos Rapports' }}
            </h2>
            @if(isset($data['description']) && $data['description'])
                <p class="ul-section-descr"
                   @if(isset($data['text_color']) && $data['text_color']) style="color: {{ $data['text_color'] }};" @endif>
                    {{ $data['description'] }}
                </p>
            @endif
        </div>

        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 g-4 mt-5">
            @php
                $reports = \App\Models\Report::where('active', true)
                    ->orderBy('order')
                    ->orderBy('publication_date', 'desc')
                    ->take($data['max_reports'] ?? 6)
                    ->get();
            @endphp

            @forelse($reports as $report)
                <div class="col">
                    <div class="ul-report-card">
                        <div class="ul-report-card-img">
                            @if($report->image)
                                <img src="{{ asset('storage/' . $report->image) }}" alt="{{ $report->title }}">
                            @else
                                <div class="ul-report-card-no-img">
                                    <i class="fas fa-file-pdf fa-3x"></i>
                                </div>
                            @endif
                            @if($report->publication_date)
                                <div class="ul-report-card-date">
                                    <span class="day">{{ $report->publication_date->format('d') }}</span>
                                    <span class="month">{{ $report->publication_date->locale('fr')->format('M') }}</span>
                                    <span class="year">{{ $report->publication_date->format('Y') }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="ul-report-card-content">
                            <h3 class="ul-report-card-title">{{ $report->title }}</h3>
                            
                            @if($report->description)
                                <p class="ul-report-card-text">{{ Str::limit($report->description, 100) }}</p>
                            @endif
                            
                            @if($report->pdf_file)
                                <a href="{{ asset('storage/' . $report->pdf_file) }}" class="ul-report-download-btn" target="_blank">
                                    <i class="fas fa-download me-2"></i> Télécharger
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>Aucun rapport disponible pour le moment.</p>
                </div>
            @endforelse
        </div>
        
        @if(count($reports) > 0 && isset($data['button_text']) && $data['button_text'] && isset($data['button_url']) && $data['button_url'])
            <div class="text-center mt-5">
                <a href="{{ $data['button_url'] }}" class="ul-btn">
                    <i class="flaticon-fast-forward-double-right-arrows-symbol"></i> {{ $data['button_text'] }}
                </a>
            </div>
        @endif
    </div>
</section>
<!-- REPORTS SECTION END --> 