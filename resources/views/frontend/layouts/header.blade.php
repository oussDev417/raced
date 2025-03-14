<!-- SIDEBAR SECTION START -->
<div class="ul-sidebar">
    <!-- header -->
    <div class="ul-sidebar-header">
        <div class="ul-sidebar-header-logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/images/logo.jpg') }}" alt="{{ $settings->site_name ?? 'RACED ONG' }}" style="height:100px; width:100px;">
            </a>
        </div>
        <!-- sidebar closer -->
        <button class="ul-sidebar-closer"><i class="flaticon-close"></i></button>
    </div>

    <div class="ul-sidebar-header-nav-wrapper d-block d-lg-none"></div>

    <!-- sidebar footer -->
    <div class="ul-sidebar-footer">
        <span class="ul-sidebar-footer-title">Suivez-nous</span>

        <div class="ul-sidebar-footer-social">
            @if($settings->facebook ?? true)
                <a href="{{ $settings->facebook_url ?? '' }}"><i class="flaticon-facebook"></i></a>
            @endif
            @if($settings->twitter ?? true)
                <a href="{{ $settings->twitter_url ?? '' }}"><i class="flaticon-twitter-1"></i></a>
            @endif
            @if($settings->instagram ?? true)
                <a href="{{ $settings->instagram_url ?? '' }}"><i class="flaticon-instagram"></i></a>
            @endif
            @if($settings->tiktok ?? true)
                <a href="{{ $settings->tiktok_url ?? '' }}"><i class="fab fa-tiktok"></i></a>
            @endif
            @if($settings->youtube ?? true)
                <a href="{{ $settings->youtube_url ?? '' }}"><i class="flaticon-youtube"></i></a>
            @endif
            @if($settings->whatsapp ?? true)
                <a href="{{ $settings->whatsapp_url ?? '' }}"><i class="fab fa-whatsapp"></i></a>
            @endif
        </div>
    </div>
</div>
<!-- SIDEBAR SECTION END -->

<!-- SEARCH MODAL SECTION START -->
<div class="ul-search-form-wrapper flex-grow-1 flex-shrink-0">
    <button class="ul-search-closer"><i class="flaticon-close"></i></button>

    <form action="#" class="ul-search-form">
        <div class="ul-search-form-right">
            <input type="search" name="search" id="ul-search" placeholder="Rechercher">
            <button type="submit"><span class="icon"><i class="flaticon-search"></i></span></button>
        </div>
    </form>
</div>
<!-- SEARCH MODAL SECTION END -->

<!-- HEADER SECTION START -->
<header class="ul-header ul-header-2">
    <div class="ul-header-top">
        <div class="ul-header-top-wrapper ul-header-container">
            <div class="ul-header-top-left">
                <span class="address"><i class="flaticon-pin"></i> {{ $settings->contact_address ?? 'Cotonou, Bénin' }}</span>
            </div>
            <div class="ul-header-top-right">
                <div class="ul-header-top-social">
                    <span class="title">Suivez-nous: </span>
                    <div class="links">
                        @if($settings->facebook ?? true)
                            <a href="{{ $settings->facebook_url ?? '' }}"><i class="flaticon-facebook"></i></a>
                        @endif
                        @if($settings->twitter ?? true)
                            <a href="{{ $settings->twitter_url ?? '' }}"><i class="flaticon-twitter-1"></i></a>
                        @endif
                        @if($settings->instagram ?? true)
                            <a href="{{ $settings->instagram_url ?? '' }}"><i class="flaticon-instagram"></i></a>
                        @endif
                        @if($settings->tiktok ?? true)
                            <a href="{{ $settings->tiktok_url ?? '' }}"><i class="flaticon-youtube"></i></a>
                        @endif
                        @if($settings->youtube ?? true)
                            <a href="{{ $settings->youtube_url ?? '' }}"><i class="flaticon-youtube"></i></a>
                        @endif
                        @if($settings->linkedin ?? true)
                            <a href="{{ $settings->linkedin_url ?? '#' }}"><i class="flaticon-linkedin-big-logo"></i></a>
                        @endif
                        @if($settings->whatsapp ?? true)
                            <a href="{{ $settings->whatsapp_url ?? '' }}"><i class="fab fa-whatsapp"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ul-header-bottom to-be-sticky">
        <div class="ul-header-bottom-wrapper ul-header-container">
            <div class="logo-container">
                <a href="{{ route('home') }}" class="d-inline-block">
                    <img src="{{ asset('assets/images/logo.jpg') }}" alt="{{ $settings->site_name ?? 'RACED ONG' }}" style="height:100px; width:100px;">
                </a>
            </div>

            <!-- header nav -->
            <div class="ul-header-nav-wrapper">
                <div class="to-go-to-sidebar-in-mobile">
                    <nav class="ul-header-nav">
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Accueil</a>
                        <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">A propos</a>
                        <a href="{{ route('axes') }}" class="{{ request()->routeIs('opportunites') ? 'active' : '' }}">Nos opportunités</a>
                        <a href="{{ route('projects.index') }}" class="{{ request()->routeIs('projects.*') ? 'active' : '' }}">Nos projets</a>
                        <a href="{{ route('news.index') }}" class="{{ request()->routeIs('news.*') ? 'active' : '' }}">Nos actualités</a>
                        <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Nous contacter</a>
                        <a href="{{ route('donation') }}" class="{{ request()->routeIs('donation') ? 'active' : '' }}">Nous soutenir</a>
                    </nav>
                </div>
            </div>

            <!-- actions -->
            <div class="ul-header-actions">
                <button class="ul-header-search-opener"><i class="flaticon-search"></i></button>
                <a href="{{ route('donation') }}" class="ul-btn d-sm-inline-flex d-none"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Nous soutenir </a>
                <button class="ul-header-sidebar-opener d-lg-none d-inline-flex"><i class="flaticon-menu"></i></button>
            </div>
        </div>
    </div>
</header>
<!-- HEADER SECTION END -->