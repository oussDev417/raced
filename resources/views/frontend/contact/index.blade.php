@extends('frontend.layouts.master')

@section('title', 'Contactez-nous')

@section('content')

<!-- Page Heading Section Start -->	
<div class="pagehding-sec">
    <div class="images-overlay"></div>		
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-heading">
                    <h1>Nous contacter</h1>
                </div>
            </div>				
        </div>
    </div>
</div>
<!-- Page Heading Section End -->	

<!-- Page Heading Section Start -->	
<div class="breadcrumb-sec">	
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-left">
                    <ul>
                        <li><a href="{{ route('home') }}">Accueil</a></li>
                        <li><a href="#">Nous contacter</a></li>
                    </ul>
                </div>
            </div>	
        </div>
    </div>
</div>
<!-- Page Heading Section End -->

<!-- Contact Page Section Start -->
<div class="contact-page-sec pt-100 pb-80">
    <div class="container">
        <div class="row">				
            <div class="col-md-5">
                <div class="contact-info">
                    <div class="how-to-help-box">
                        <div class="help-box-item">
                            <div class="help-box-icon">
                                <img src="img/icon/c_i_1.png" alt=""/>
                            </div>
                            <div class="help-box-text">
                                <h2>Adresse</h2>
                                <p>{{ $settings->contact_address ?? 'Cotonou, Aibatin, Immeuble Le Verseau' }}</p>
                            </div>
                        </div>							
                        <div class="help-box-item">
                            <div class="help-box-icon">
                                <img src="img/icon/c_i_2.png" alt=""/>
                            </div>
                            <div class="help-box-text">
                                <h2>Téléphone</h2>
                                <p>{{ $settings->contact_phone ?? '+229 57-70-28-05' }}</p>
                            </div>
                        </div>						
                        <div class="help-box-item">
                            <div class="help-box-icon">
                                <img src="img/icon/c_i_3.png" alt=""/>
                            </div>
                            <div class="help-box-text">
                                <h2>Email</h2>
                                <p>{{ $settings->contact_email ?? 'ongcarrefourjeunesseafrique@gmail.com' }}</p>
                            </div>
                        </div>				
                    </div>						
                </div>
            </div>
            <div class="col-md-7">
                <div class="contact-page-map">
                    <iframe src="{{ $settings->google_maps ?? '' }}" width="700" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>				
            </div>
            <div class="contact-page-form">
                <div class="col-md-8">
                    <div class="">
                        <form action="{{ route('contact.store') }}" method="post" class="container p-4 rounded shadow bg-white" style="max-width: 600px;">
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

                            <h2 class="text-center mb-4">Envoyez votre message</h2>

                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Votre Nom" required>
                            </div>

                            <div class="mb-3">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" name="prenom" class="form-control" id="prenom" placeholder="Votre Prénom" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Votre Email" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Téléphone</label>
                                <input type="text" name="phone" class="form-control" id="phone" placeholder="Votre téléphone">
                            </div>

                            <div class="mb-3">
                                <label for="objet" class="form-label">Objet</label>
                                <input type="text" name="objet" class="form-control" id="objet" placeholder="Objet" required>
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea name="message" class="form-control" id="message" rows="4" placeholder="Votre message" required></textarea>
                            </div>

                            <div class="d-grid text-align: center">
                                <button type="submit" class="btn btn-primary">Envoyer</button>
                            </div>
                        </form>
                    </div>				
                </div>				
                <div class="col-md-4">
                    <div class="event-ticket-widget">
                        <div class="support-widget">
                            <img src="img/admin-ajax-1.jpg" style="width: 400px; height: 250px;" alt="">	
                        </div>	
                        <div class="feature-event-text">								
                            <div class="col-md-12 col-sm-12 col-xs-12">								
                                <div class="event-meta">
                                    <p>
                                        L'Equipe de Carrefour Jeunesse Afrique
                                    </p>
                                </div>
                            </div>						
                        </div>						
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Page Section End -->

@endsection