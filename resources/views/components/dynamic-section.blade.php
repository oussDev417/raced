<div class="section {{ $customClass ?? '' }}">
    <div class="container">
        @if(isset($title))
            <h2 class="section-title">{{ $title }}</h2>
        @endif
        
        @if(isset($subtitle))
            <p class="section-subtitle">{{ $subtitle }}</p>
        @endif
        
        <div class="section-content">
            <!-- Section non trouvée ou non configurée -->
            <div class="alert alert-warning">
                La section <strong>{{ $section->name }}</strong> n'a pas de template associé.
            </div>
        </div>
    </div>
</div>