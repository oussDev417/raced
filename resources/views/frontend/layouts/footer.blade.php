<!-- Footer Area Start -->
<footer>
    <div class="footer-overlay"></div>
    <div class="footer-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="footer-info">
                        <h2>{{ $settings->site_name ?? 'Carrefour Jeunesse Afrique' }}</h2>
                        @if($settings->contact_hours)
                        <p><strong>Horaires</strong><br>{!! $settings->contact_hours !!}</p>
                        @else
                            <p>
                                <strong>Horaires</strong><br>
                                Du lundi au vendredi : 8h - 12h et 14h - 18h (heure administrative) <br>
                                Mercredi et samedi : 15h - 18h (heure d'animation)
                            </p>
                        @endif
                        <div class="social-profile">
                            <ul>
                                @if($settings->facebook ?? true)
                                    <li><a href="{{ $settings->facebook_url ?? 'https://web.facebook.com/Carrefour-Jeunesse-Afrique-100329659021639' }}"><i class="fab fa-facebook-f"></i></a></li>
                                @endif
                                @if($settings->instagram ?? true)
                                    <li><a href="{{ $settings->instagram_url ?? 'https://www.instagram.com/carrefour_jeunesse_afrique/?hl=fr' }}"><i class="fab fa-instagram"></i></a></li>
                                @endif
                                @if($settings->linkedin ?? false)
                                    <li><a href="{{ $settings->linkedin_url ?? '#' }}"><i class="fab fa-linkedin-in"></i></a></li>
                                @endif
                                @if($settings->tiktok ?? true)
                                    <li><a href="{{ $settings->tiktok_url ?? 'https://www.tiktok.com/@carrefour_jeunesse_afrique' }}"><i class="fab fa-tiktok"></i></a></li>
                                @endif
                                @if($settings->twitter ?? true)
                                    <li><a href="{{ $settings->twitter_url ?? 'https://twitter.com/CarrefourJaw' }}"><i class="fab fa-twitter"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="footer-contact">
                        <h2>République du Bénin</h2>
                        <p>
                            <strong>Adresse :</strong> {{ $settings->contact_address ?? 'Mono, Comè – Centre, Quartier Hongodé' }}<br>
                            <strong>Rue :</strong> {{ $settings->contact_street ?? 'n°3296 Danzounmé' }}<br>
                            <strong>Email :</strong> <strong>{{ $settings->contact_email ?? 'ongcarrefourjeunesseafrique@gmail.com' }}</strong><br>
                            <strong>Téléphone : {{ $settings->contact_phone ?? '+229 57-70-28-05' }}</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Bottom Section Start -->
    <div class="footer-bottom-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>&copy; {{ date('Y') }} {{ $settings->site_name ?? 'Carrefour Jeunesse Afrique' }} | Tous droits réservés | <a href="{{ route('about') }}">Mentions légales</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Bottom Section End -->
</footer>
<!-- Footer Area End -->