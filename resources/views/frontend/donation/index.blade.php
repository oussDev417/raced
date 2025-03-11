@extends('frontend.layouts.master')

@section('title', 'Nous soutenir')

@section('content')

<!-- Page Heading Section Start -->	
<div class="pagehding-sec">
    <div class="images-overlay"></div>		
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-heading">
                    <h1>Nous soutenir</h1>
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
                        <li><a href="#">Nous soutenir</a></li>
                    </ul>
                </div>
            </div>	
        </div>
    </div>
</div>
<!-- Page Heading Section End -->

<!-- Faq Section Start -->
<div class="fag-sec pt-100 pb-100">	
    <div class="container">				
        <div class="row">	
            <div class="faq-gallery">											
                <div class="collapse navbar-collapse" id="navbarfiltr">
                </div>
                <div class="filtr-container">	
                    <div class="col-sm-6 col-md-6 inner filtr-item event vacancy join_us">
                        <div class="sec-title">
                            <h1>Nous soutenir</h1>
                            <div class="border-shape"></div>
                        </div>
                    </div>	
                    <div class="col-sm-6 col-md-6 inner filtr-item event causes">
                        <h2 class="faq-title">Don sur le compte de Carrefour Jeunesse Afrique (CJA)</h2>			
                        <div class="panel-group" id="accordion" role="tablist">
                            <div class="panel">
                                <div>
                                    <div class="panel-content">
                                        <p style="text-align: justify;">
                                            Vous versez votre don sur le compte de Carrefour Jeunesse Afrique:
                                            <br>
                                            N° 513100001386.
                                            <br><br>
                                            Votre participation, aussi modeste soit-elle, constitue le meilleur soutien pour la poursuite de nos projets.
                                            <br><br>
                                            Vous bénéficiez d'une déduction fiscale à partir de 40 euros de dons par an. Une attestation fiscale vous sera envoyée dès votre premier trimestre suivant l'année de votre don/vos dons.
                                        </p>
                                    </div>
                                </div>
                            </div>													
                        </div>					
                        <div class="faq-sec">
                            <h2 class="faq-title">Lever de fonds pour la construction du siège</h2>
                            <div class="panel-group" id="accordion" role="tablist">
                                <div class="panel">
                                    <div>
                                        <div class="panel-content">
                                            <p style="text-align: justify;">
                                                Vous pouvez contribuer à la construction de notre siège en faisant un don via le bouton suivant :
                                                <br><br>
                                                <a href="" class="btn btn-success" target="_blank">Faire un don</a>
                                                <br><br>
                                                Chaque contribution, aussi modeste soit-elle, nous rapproche de notre objectif.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="faq-sec">
                            <h2 class="faq-title">Faire un ordre permanent</h2>			
                            <div class="panel-group" id="accordion" role="tablist">
                                <div class="panel">
                                    <div>
                                        <div class="panel-content">
                                            <p style="text-align: justify;">
                                                Un don, fait par ordre permanent ou par domiciliation, nous permet de planifier nos actions dans le moyen ou le long terme.
                                                <br>
                                                <br>
                                                Pour vous, c'est la satisfaction de participer à nos actions dans la durée. C'est sortir d'une action de charité pour rentrer dans une véritable logique de développement durable.	
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
    </div>
</div>
<!-- Faq Section End -->

<!-- Partenaires -->
@include('frontend.layouts.partials.partners') 
@endsection