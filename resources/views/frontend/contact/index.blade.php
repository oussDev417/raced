@extends('frontend.layouts.master')

@section('title', 'Contactez-nous')

@section('content')
<!-- BREADCRUMBS SECTION START -->
<section class="ul-breadcrumb ul-section-spacing">
    <div class="ul-container">
        <h2 class="ul-breadcrumb-title">Contactez-nous</h2>
        <ul class="ul-breadcrumb-nav">
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li><span class="separator"><i class="flaticon-right"></i></span></li>
            <li>Contactez-nous</li>
        </ul>
    </div>
</section>
<!-- BREADCRUMBS SECTION END -->

<!-- CONTACT INFOS SECTION START -->
<div class="ul-contact-infos">
    <div class="ul-section-spacing ul-container">
        <div class="row row-cols-md-3 row-cols-2 row-cols-xxs-1 ul-bs-row">
            <!-- single info -->
            <div class="col">
                <div class="ul-contact-info">
                    <div class="icon"><i class="flaticon-location"></i></div>
                    <div class="txt">
                        <span class="title">Adresse</span>
                        <span class="descr">{{ $settings->contact_address ?? 'Cotonou, Aibatin, Immeuble Le Verseau' }}</span>
                    </div>
                </div>
            </div>
            <!-- single info -->
            <div class="col">
                <div class="ul-contact-info">
                    <div class="icon"><i class="flaticon-phone-call"></i></div>
                    <div class="txt">
                        <span class="title">Téléphone</span>
                        <a href="tel:{{ $settings->contact_phone ?? '+229 57-70-28-05' }}">{{ $settings->contact_phone ?? '+229 57-70-28-05' }}</a>
                    </div>
                </div>
            </div>
            <!-- single info -->
            <div class="col">
                <div class="ul-contact-info">
                    <div class="icon"><i class="flaticon-comment"></i></div>
                    <div class="txt">
                        <span class="title">Email</span>
                        <a href="mailto:{{ $settings->contact_email ?? 'ongcarrefourjeunesseafrique@gmail.com' }}">{{ $settings->contact_email ?? 'ongcarrefourjeunesseafrique@gmail.com' }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CONTACT INFOS SECTION END -->

<!-- MAPS SECTION START -->
<div class="ul-contact-map">
    <iframe src="{{ $settings->google_maps ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4273.369923927683!2d89.24843545559786!3d25.755317550773302!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e32e0754341e5f%3A0xa50209e1e2d5aed5!2sRangpur%20Zoo!5e0!3m2!1sen!2sbd!4v1736854209235!5m2!1sen!2sbd' }}" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<!-- MAPS SECTION END -->

<!-- CONTACT SECTION START -->
<section class="ul-inner-contact ul-section-spacing">
    <div class="ul-section-heading justify-content-center text-center">
        <div>
            <span class="ul-section-sub-title">Contactez-nous</span>
            <h2 class="ul-section-title">Envoyez-nous votre message</h2>
        </div>
    </div>

    <div class="ul-inner-contact-container">
        <form action="{{ route('contact.store') }}" method="post" class="ul-contact-form ul-form">
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
            
            <div class="row row-cols-2 row-cols-xxs-1 ul-bs-row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" name="name" id="name" placeholder="Votre Nom" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input type="text" name="prenom" id="prenom" placeholder="Votre Prénom" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input type="email" name="email" id="email" placeholder="Votre Email" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input type="text" name="phone" id="phone" placeholder="Votre téléphone">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <input type="text" name="objet" id="objet" placeholder="Objet" required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <textarea name="message" id="message" placeholder="Votre message" required></textarea>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Envoyer</button>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- CONTACT SECTION END -->

@endsection