<!-- FEATURES SECTION START -->
<section class="ul-features ul-section-spacing">
    <div class="ul-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="sec-title text-center mb-4">
                    <h1>Nos Valeurs</h1>
                    <div class="border-shape"></div>
                </div>
            </div>
        </div>
        <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4 justify-content-center">
            @if(isset($about) && $about->values)
                @php
                    $valuesHtml = $about->values;
                    $dom = new DOMDocument();
                    libxml_use_internal_errors(true);
                    $dom->loadHTML(mb_convert_encoding($valuesHtml, 'HTML-ENTITIES', 'UTF-8'));
                    libxml_clear_errors();
                    
                    $valuesList = $dom->getElementsByTagName('li');
                    $values = [];
                    
                    foreach ($valuesList as $item) {
                        $values[] = trim($item->textContent);
                    }
                @endphp
                
                @foreach($values as $value)
                    <!-- single feature -->
                    <div class="col">
                        <div class="ul-feature">
                            <div class="ul-feature-icon">
                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 0C8.05887 0 0 8.05887 0 18C0 27.9411 8.05887 36 18 36C27.9411 36 36 27.9411 36 18C36 8.05887 27.9411 0 18 0ZM18 32.4C10.0472 32.4 3.6 25.9528 3.6 18C3.6 10.0472 10.0472 3.6 18 3.6C25.9528 3.6 32.4 10.0472 32.4 18C32.4 25.9528 25.9528 32.4 18 32.4Z" fill="#EB5310"/>
                                    <path d="M25.2 13.5L16.2 22.5L10.8 17.1L8.1 19.8L16.2 27.9L27.9 16.2L25.2 13.5Z" fill="#EB5310"/>
                                </svg>
                            </div>
                            <h3 class="ul-feature-title">{{ $value }}</h3>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
<!-- FEATURES SECTION END -->