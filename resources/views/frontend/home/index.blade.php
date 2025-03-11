@extends('frontend.layouts.master')

@section('title', isset($settings) ? $settings->site_name : 'ONG Carrefour Jeunesse Afrique')

@section('content')
<!-- Slider Section Start -->
<div class="slider">
    <div class="all-slide owl-item">
        @forelse($sliders ?? [] as $slider)
            @if($slider->status == 1) <!-- Vérifier si le slider est actif -->
                <div class="single-slide" style="background-image:url({{ asset('storage/' . $slider->image) }});">
                    <div class="slider-overlay"></div>
                    <div class="slider-wraper">
                        <div class="slider-text">
                            <div class="slider-inner">
                                <h1>{{ $slider->title }}</h1>
                                @if($slider->subtitle)
                                    <h2>{{ $slider->subtitle }}</h2>
                                @endif
                            </div>
                            <ul>
                                @if($slider->button_text && $slider->button_link)
                                    <li><a href="{{ $slider->button_link }}">{{ $slider->button_text }}</a></li>
                                @endif
                                @if($slider->button_text_2 && $slider->button_link_2)
                                    <li><a href="{{ $slider->button_link_2 }}">{{ $slider->button_text_2 }}</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <!-- Affichage des slides par défaut si aucun slide n'est disponible -->
            <div class="single-slide" style="background-image:url({{ asset('assets/img/slider.jpg') }});">
                <div class="slider-overlay"></div>
                <div class="slider-wraper">
                    <div class="slider-text">
                        <div class="slider-inner">
                            <h1>Carrefour Jeunesse Afrique</h1>
                            <h2>CENTRE SOCIO - EDUCATIF D'AIDE A L'ENFANCE, L'ADOLESCENCE ET A LA JEUNESSE</h2>
                        </div>
                        <ul>
                            <li><a href="{{ route('donation') }}">Nous soutenir</a></li>
                            <li><a href="{{ route('contact') }}">Nous contacter</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="single-slide" style="background-image:url({{ asset('assets/img/slider2.jpg') }});">
                <div class="slider-overlay"></div>
                <div class="slider-wraper">
                    <div class="slider-text">
                        <div class="slider-inner">
                            <h1>Formations professionnelles et orientations</h1>
                            <h2>Les formations professionnelles des jeunes vulnérables, ces derniers sont envoyés dans des ateliers en dehors du centre auprès des maitres artisans..</h2>
                        </div>
                        <ul>
                            <li><a href="{{ route('donation') }}">Nous soutenir</a></li>
                            <li><a href="{{ route('contact') }}">Nous contacter</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="single-slide" style="background-image:url({{ asset('assets/img/slider3.jpg') }});">
                <div class="slider-overlay"></div>
                <div class="slider-wraper">
                    <div class="slider-text">
                        <div class="slider-inner">
                            <h1>Un engagement citoyen pour un avenir durable</h1>
                            <h2>Protéger l'environnement, promouvoir l'éducation et la justice sociale : chaque action compte pour bâtir une société équitable et responsable.</h2>
                        </div>
                        <ul>
                            <li><a href="{{ route('donation') }}">Nous soutenir</a></li>
                            <li><a href="{{ route('contact') }}">Nous contacter</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
<!-- Slider Section End -->

<!-- Recent Causes Section Start -->	
@if(isset($axes) && count($axes) > 0)
<div class="recent-causes-sec pt-100 pb-70">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="sec-title">
					<h1>Nos Axes Stratégiques</h1>
					<div class="border-shape"></div>
				</div>
			</div>
		</div>			
		<div class="row">
			@foreach($axes as $axe)
			<div class="col-md-4 col-sm-4">
				<div class="single-causes">
					<div class="causes-thumb">
						<img src="{{ asset('storage/axes/' . ($axe->image ?? 'default.jpg')) }}" alt="{{ $axe->title }}"/>
					</div>
					<div class="single-causes-text">
						<h2><a href="{{ route('about') }}#axes">{{ $axe->title }}</a></h2>
					</div>				
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endif
<!-- Recent Causes Section End -->

 <!-- How To Help Section Start -->	
 <div class="how-to-help-sec pt-100 pb-70">
		<div class="how-to-help-sec-overlay"></div>
		<div class="container">
			<div class="row">
				<!-- Boîte de don -->
				<div class="col-md-6">
					<div class="donate-box">
						<img src="{{ asset('assets/img/p1.jpg') }}" alt="Aide aux enfants sans abri" />
						<div class="donate-box-inner">
							<div class="donate-box-text">	
								<h2>Soutener une cause noble</h2>
							</div>			
							<div class="donate-box-button">
								<a href="{{ route('donation') }}">Nous soutenir</a>
							</div>
						</div>
					</div>
				</div>				
	
				<!-- Comment nous aider -->
				<div class="col-md-6">
					<div class="sec-title">
						<h1>Comment nous soutenir</h1>
						<div class="border-shape"></div>
					</div>										
	
					<div class="how-to-help-box">
						<!-- Envoyer un don -->
						<div class="help-box-item">
							<div class="help-box-icon">
								<img src="img/icon/h1.png" alt="Envoyer un don" />
							</div>
							<div class="help-box-text">
								<h2>Faire un don</h2>
								<p>Vos dons permettent d'offrir un avenir meilleur aux enfants en difficulté. Chaque contribution compte.</p>
							</div>
						</div>							
	
						<!-- Devenir bénévole -->
						<div class="help-box-item">
							<div class="help-box-icon">
								<img src="img/icon/h2.png" alt="Devenir bénévole" />
							</div>
							<div class="help-box-text">
								<h2>Devenir bénévole</h2>
								<p>Rejoignez notre équipe et participez activement à nos actions pour le bien-être des enfants.</p>
							</div>
						</div>						
	
						<!-- Partager sur les réseaux sociaux -->
						<div class="help-box-item">
							<div class="help-box-icon">
								<img src="img/icon/h3.png" alt="Partager sur les réseaux sociaux" />
							</div>
							<div class="help-box-text">
								<h2>Partager sur les réseaux sociaux</h2>
								<p>Diffusez notre mission en partageant nos actions et en sensibilisant votre entourage.</p>
							</div>
						</div>				
					</div>
				</div>
			</div>
		</div>
	</div>		
	<!-- How To Help Section End -->

<!-- Become Volunteer Section Start -->	
<div class="become-volunteer-sec">
	<div class="container">
		<div class="row">
			<div class="col-md-5"></div>
			<div class="col-md-7 col-sm-12 col-xs-12">
				<div class="volunteer-form">
					<div class="volunteer-form-overlay"></div>
					<h5>Donnez un coup de main</h5>
					<h1>Devenez bénévole</h1>
					<div class="row">
						<form action="{{ route('benevole.store') }}" method="POST">
							@csrf
							<div class="col-md-6 col-sm-6">
								<input type="text" name="prenom" placeholder="Prénom" required/> 
							</div>
							<div class="col-md-6 col-sm-6">
								<input type="text" name="name" placeholder="Nom" required/> 
							</div>
							<div class="col-md-6 col-sm-6">
								<input type="email" name="email" placeholder="E-mail" required/> 
							</div>				
							<div class="col-md-6 col-sm-6">
								<input type="tel" name="phone" placeholder="Téléphone" required/> 
							</div>
                            <div class="col-md-12">
								<div class="checkbox-field">
									<input type="checkbox" id="formcheck" required>
									<label for="formcheck">J'accepte les conditions générales et m'engage à respecter les valeurs de l'association.</label>	
								</div>	
							</div>
							<div class="col-md-12">
								<input type="submit" value="Envoyer"/>
							</div>
							
							@if(session('success'))
								<div class="col-md-12">
									<div class="alert alert-success">
										{{ session('success') }}
									</div>
								</div>
							@endif
							@error('name')
								<div class="col-md-12">
									<div class="alert alert-danger">
										{{ $message }}
									</div>
								</div>
							@enderror
							@error('prenom')
								<div class="col-md-12">
									<div class="alert alert-danger">
										{{ $message }}
									</div>
								</div>
							@enderror
							@error('email')
								<div class="col-md-12">
									<div class="alert alert-danger">
										{{ $message }}
									</div>
								</div>
							@enderror
							@error('phone')
								<div class="col-md-12">
									<div class="alert alert-danger">
										{{ $message }}
									</div>
								</div>
							@enderror
						</form>
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>		
<!-- Become Volunteer Section End -->

<!-- Count Up Section Start -->	
<div class="count-up-sec">
	<div class="count-up-sec-overlay"></div>
	<div class="container">
		<div class="row">						
			<div class="col-md-3 col-sm-6 col-xs-6 inner">
				<div class="counting_sl">
					<div class="countup-icon">
						<img src="img/icon/manager.png" alt=""/>
					</div>
					<div class="countup-text">
						<h2 class="counter">{{ $statFacts[0]->counter ?? '5468' }}</h2>
						<h4>{{ $statFacts[0]->title ?? 'Donateurs' }}</h4>						
					</div>
				</div>
			</div>					
			<div class="col-md-3 col-sm-6 col-xs-6 inner">
				<div class="counting_sl">
					<div class="countup-icon">
						<img src="img/icon/exam.png" alt=""/>
					</div>
					<div class="countup-text">
						<h2 class="counter">{{ $statFacts[1]->counter ?? '6875' }}</h2>
						<h4>{{ $statFacts[1]->title ?? 'Projets réalisés' }}</h4>						
					</div>
				</div>
			</div>					
			<div class="col-md-3 col-sm-6 col-xs-6 inner">
				<div class="counting_sl">
					<div class="countup-icon">
						<img src="img/icon/users.png" alt=""/>
					</div>
					<div class="countup-text">
						<h2 class="counter">{{ $statFacts[2]->counter ?? '6875' }}</h2>
						<h4>{{ $statFacts[2]->title ?? 'Bénévoles' }}</h4>						
					</div>
				</div>				
			</div>					
			<div class="col-md-3 col-sm-6 col-xs-6 inner">
				<div class="counting_sl">
					<div class="countup-icon">
						<img src="img/icon/coins.png" alt=""/>
					</div>
					<div class="countup-text">
						<h2 class="counter">{{ $statFacts[3]->counter ?? '45,000' }}</h2>
						<h4>{{ $statFacts[3]->title ?? 'Montant collecté' }}</h4>						
					</div>
				</div>
			</div>												
		</div>					
	</div>
</div>	
<!-- Count Up Section End -->

<!-- Fun Facts Section Start -->
@if(isset($funFacts) && count($funFacts) > 0)
<div class="event-sec pt-100 pb-70">
	<div class="container">
		<style>
			.highlight {
				background-color: #8DC63F;
				color: white;
				padding: 5px 10px;
				border-radius: 5px;
				font-weight: bold;
			}
			.stat-card {
				display: flex;
				align-items: center;
				margin-top: 20px;
			}
			.stat-icon {
				width: 80px;
				height: 70px;
				border-radius: 50%;
				display: flex;
				justify-content: center;
				align-items: center;
				font-size: 24px; 
				font-weight: bold;
				margin-right: 15px;
				color: white;
			}
			.icon-green { background-color: #8DC63F; }
			.icon-blue { background-color: #042a41; }
			.icon-red { background-color: #F9A126; }
			.icon-yellow { background-color: #042a41; }
			.stat-text {
				font-size: 18px;
			}
		</style>
		<div class="row">
			<!-- Titre -->
			<div class="col-lg-6">
				<div class="sec-title">
					<h1>Quelques Statistiques</h1>
					<div class="border-shape"></div>
				</div>
				<h1><strong>Carrefour Jeunesse Afrique</strong></h1>
				<p class="highlight">Un centre d'aide à l'enfance, à l'adolescence et à la jeunesse</p>
	
				<!-- Statistiques -->
				@foreach($funFacts as $index => $fact)
				<div class="stat-card">
					<div class="stat-icon icon-{{ ['green', 'blue', 'red', 'yellow'][$index % 4] }}">{{ $fact->count }}</div>
					<p class="stat-text">{{ $fact->title }}</p>
				</div>
				@endforeach
			</div>
	
			<!-- Image -->
			<div class="col-lg-6 d-flex align-items-center">
				<img src="{{ asset('assets/img/enfants_souriants.jpeg') }}" alt="Enfants souriants" class="img-fluid rounded">
			</div>
		</div>
	</div>
</div>
@endif
<!-- Fun Facts Section End -->

<!-- Partenaires -->
@include('frontend.layouts.partials.partners')
@endsection 