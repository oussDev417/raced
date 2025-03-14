<!-- FOOTER SECTION START -->
<footer class="ul-footer">
    <div class="ul-footer-top">
        <div class="ul-footer-container">
            <div class="ul-footer-top-contact-infos">
                <!-- single info -->
                <div class="ul-footer-top-contact-info">
                    <!-- icon -->
                    <div class="ul-footer-top-contact-info-icon">
                        <div class="ul-footer-top-contact-info-icon-inner">
                            <i class="flaticon-pin"></i>
                        </div>
                    </div>
                    <!-- txt -->
                    <div class="ul-footer-top-contact-info-txt">
                        <span class="ul-footer-top-contact-info-label">Adresse</span>
                        <h5 class="ul-footer-top-contact-info-address">{{ $settings->contact_address ?? '' }}</h5>
                    </div>
                </div>

                <!-- single info -->
                <div class="ul-footer-top-contact-info">
                    <!-- icon -->
                    <div class="ul-footer-top-contact-info-icon">
                        <div class="ul-footer-top-contact-info-icon-inner">
                            <i class="flaticon-email"></i>
                        </div>
                    </div>
                    <!-- txt -->
                    <div class="ul-footer-top-contact-info-txt">
                        <span class="ul-footer-top-contact-info-label">Email</span>
                        <h5 class="ul-footer-top-contact-info-address"><a href="mailto:{{ $settings->contact_email ?? '' }}">{{ $settings->contact_email ?? '' }}</a></h5>
                    </div>
                </div>

                <!-- single info -->
                <div class="ul-footer-top-contact-info">
                    <!-- icon -->
                    <div class="ul-footer-top-contact-info-icon">
                        <div class="ul-footer-top-contact-info-icon-inner">
                            <i class="flaticon-telephone-call-1"></i>
                        </div>
                    </div>
                    <!-- txt -->
                    <div class="ul-footer-top-contact-info-txt">
                        <span class="ul-footer-top-contact-info-label">Téléphone</span>
                        <h5 class="ul-footer-top-contact-info-address"><a href="tel:{{ $settings->contact_phone ?? '' }}">{{ $settings->contact_phone ?? '' }}</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ul-footer-middle">
        <div class="ul-footer-container">
            <div class="ul-footer-middle-wrapper wow animate__fadeInUp">
                <div class="ul-footer-about">
                    <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo/logo.png') }}" alt="logo" class="logo"> <span style="color: white; font-weight: bold; font-size: 15px;">RACED ONG</span></a>
                    <!-- <p class="ul-footer-about-txt">{{ $settings->site_name ?? '' }}</p> -->
                    <div class="ul-footer-socials">
                        @if($settings->facebook ?? true)
                            <a href="{{ $settings->facebook_url ?? '' }}"><i class="flaticon-facebook"></i></a>
                        @endif
                        @if($settings->twitter ?? true)
                            <a href="{{ $settings->twitter_url ?? '' }}"><i class="flaticon-twitter-1"></i></a>
                        @endif
                        @if($settings->linkedin ?? true)
                            <a href="{{ $settings->linkedin_url ?? '#' }}"><i class="flaticon-linkedin-big-logo"></i></a>
                        @endif
                        @if($settings->instagram ?? true)
                            <a href="{{ $settings->instagram_url ?? '' }}"><i class="flaticon-instagram"></i></a>
                        @endif
                    </div>
                    <div class="ul-footer-socials">
                        
                        @if($settings->tiktok ?? true)
                            <a href="{{ $settings->tiktok_url ?? 'https://www.tiktok.com/@racedong01' }}"><i class="fab fa-tiktok"></i></a>
                        @endif
                        @if($settings->youtube ?? true)
                            <a href="{{ $settings->youtube_url ?? '' }}"><i class="flaticon-youtube"></i></a>
                        @endif
                        @if($settings->whatsapp ?? true)
                            <a href="{{ $settings->whatsapp_url ?? '' }}"><i class="fab fa-whatsapp"></i></a>
                        @endif
                    </div>
                </div>

                <div class="ul-footer-widget">
                    <h3 class="ul-footer-widget-title">Liens Rapides</h3>

                    <div class="ul-footer-widget-links">
                        <a href="{{ route('home') }}">Accueil</a>
                        <a href="{{ route('about') }}">À Propos</a>
                        <a href="{{ route('news.index') }}">Actualités</a>
                        <a href="{{ route('contact') }}">Contactez-nous</a>
                    </div>
                </div>

                <div class="ul-footer-widget ul-footer-recent-posts">
                    <h3 class="ul-footer-widget-title">Horaires</h3>
                    <div class="ul-footer-widget-links ul-footer-contact-links">
                        @if($settings->contact_hours)
                            <p>{!! $settings->contact_hours !!}</p>
                        @else
                            <p>Contactez-nous pour obtenir les horaires de notre centre.</p>
                        @endif
                    </div>
                </div>

                <div class="ul-footer-widget ul-nwsltr-widget">
                    <h3 class="ul-footer-widget-title">S'abonner à notre newsletter</h3>
                    <form action="{{ route('newsletter.store') }}" method="POST" class="ul-nwsltr-form">
                        @csrf
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach 
                                </ul>
                            </div>
                        @endif
                        
                        <div class="top">
                            <input type="email" name="email" id="nwsltr-email" placeholder="Votre adresse email" class="ul-nwsltr-input">
                            <button type="submit"><i class="flaticon-next"></i></button>
                        </div>

                        <div class="agreement">
                            <label for="nwsltr-agreement" class="ul-checkbox-wrapper">
                                <input type="checkbox" name="agreement" id="nwsltr-agreement" hidden>
                                <span class="ul-checkbox"><i class="flaticon-tick"></i></span>
                                <span class="ul-checkbox-txt">Je suis d'accord avec la <a href="#">Politique de confidentialité</a></span>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- footer bottom -->
    <div class="ul-footer-bottom">
        <div class="ul-footer-container">
            <div class="ul-footer-bottom-wrapper">
                <p class="copyright-txt">&copy; {{ date('Y') }} {{ $settings->site_name}} by <a href="https://www.xtopdigital.com" target="_blank">XTOP DIGITAL</a>. Tous droits réservés</p>
                <div class="ul-footer-bottom-nav"><a href="{{ route('about') }}">Mentions légales</a></div>
            </div>
        </div>
    </div>

    <!-- vector -->
    <div class="ul-footer-vectors">
        <img src="{{ asset('assets/img/footer-vector-img.png') }}" alt="Footer Image" class="ul-footer-vector-1">
    </div>
</footer>
<!-- FOOTER SECTION END -->