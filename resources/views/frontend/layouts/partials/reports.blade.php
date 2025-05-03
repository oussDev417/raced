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

        @php
            // Récupérer les catégories actives avec leurs rapports
            $categories = \App\Models\ReportCategory::with(['reports' => function($query) {
                $query->where('active', true)
                      ->orderBy('order')
                      ->orderBy('publication_date', 'desc');
            }])->where('active', true)->get();
        @endphp

        @foreach($categories as $category)
            @if($category->reports->count() > 0)
                <div class="category-section mt-5">
                    <h3 class="category-title">{{ $category->name }}</h3>
                    <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 g-4">
                        @foreach($category->reports as $report)
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
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach

        @if(count($categories) > 0 && isset($data['button_text']) && $data['button_text'] && isset($data['button_url']) && $data['button_url'])
            <div class="text-center mt-5">
                <a href="{{ $data['button_url'] }}" class="ul-btn">
                    <i class="flaticon-fast-forward-double-right-arrows-symbol"></i> {{ $data['button_text'] }}
                </a>
            </div>
        @endif
    </div>
</section>
<!-- REPORTS SECTION END -->

<style>
.category-section {
    margin-bottom: 40px;
}

.category-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #2e90a7;
    border-bottom: 2px solid #2e90a7;
    padding-bottom: 10px;
}

.ul-report-card {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.ul-report-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.ul-report-card-img {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.ul-report-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.ul-report-card-no-img {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 200px;
    background-color: #f8f9fa;
    color: #2e90a7;
}

.ul-report-card-date {
    position: absolute;
    bottom: 10px;
    left: 10px;
    background-color: rgba(46, 144, 167, 0.9);
    color: white;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 14px;
}

.ul-report-card-date .day {
    font-weight: bold;
    font-size: 18px;
}

.ul-report-card-date .month {
    text-transform: uppercase;
}

.ul-report-card-content {
    padding: 20px;
}

.ul-report-card-title {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #2e90a7;
}

.ul-report-card-text {
    font-size: 14px;
    color: #666;
    margin-bottom: 15px;
}

.ul-report-download-btn {
    display: inline-block;
    background-color: #2e90a7;
    color: white;
    padding: 8px 15px;
    border-radius: 4px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.ul-report-download-btn:hover {
    background-color: #247a8f;
}
</style> 