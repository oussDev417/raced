@extends('frontend.layouts.master')

@section('title', 'Notre équipe')

@section('content')
 
<!-- Page Heading Section Start -->	
<div class="pagehding-sec">
		<div class="images-overlay"></div>		
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="page-heading">
						<h1>Notre équipe</h1>
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
							<li><a href="index.html">Accueil</a></li>
							<li><a href="#">Notre équipe</a></li>
						</ul>
					</div>
				</div>	
			</div>
		</div>
	</div>
	<!-- Page Heading Section End -->

<!-- Team Area Start -->
<div class="team-sec pt-100 pb-30">
    <div class="container">
        @if(isset($equipeCategories) && count($equipeCategories) > 0)
            @foreach($equipeCategories as $category)
                <div class="row">
                    <div class="col-md-12">
                        <div class="sec-title">
                            <h1>{{ $category->title }}</h1>
                            <div class="border-shape"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @php
                        $categoryMembers = $equipes->where('equipe_category_id', $category->id);
                    @endphp
                    @if($categoryMembers->count() > 0)
                        @foreach($categoryMembers as $member)
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="team-member">
                                    @if($member->image)
                                        <img src="{{ asset('storage/equipes/' . $member->image) }}" alt="{{ $member->name }}"/>
                                    @else
                                        <img src="{{ asset('img/equipe/default.jpg') }}" alt="{{ $member->name }}"/>
                                    @endif
                                    <h2>{{ $member->name }}</h2>
                                    <p>{{ $member->position }}</p>
                                    <ul>
                                        @if(isset($member->linkedin))
                                            <li><a href="{{ $member->linkedin }}" target="_blank"><i class="fa fa-linkedin"></i> LinkedIn</a></li>
                                        @endif
                                        @if($member->phone)
                                            <li><a href="tel:{{ $member->phone }}" style="color:rgb(243, 247, 249);"><i class="fa fa-phone"></i> {{ $member->phone }}</a></li>
                                        @endif
                                        @if($member->email)
                                            <li><a href="mailto:{{ $member->email }}" style="color:rgb(243, 247, 249);"><i class="fa fa-envelope"></i> {{ $member->email }}</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-12">
                            <p class="text-center">Aucun membre trouvé dans cette catégorie.</p>
                        </div>
                    @endif
                </div>
            @endforeach
        @else
            <div class="row">
                <div class="col-md-12">
                    <div class="sec-title">
                        <h1>Le staff exécutif</h1>
                        <div class="border-shape"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="team-member">
                        <img src="{{ asset('img/equipe/default.jpg') }}" alt=""/>
                        <h2>DOSSOU M.Arielle</h2>
                        <p>Directrice exécutive</p>
                        <ul>
                            <li><a href="tel:+22966585513"><i class="fa fa-phone"></i>+22966585513</a></li>
                            <li><a href="mailto:contact@exemple.com"><i class="fa fa-envelope"></i> contact@exemple.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="team-member">
                        <img src="{{ asset('img/equipe/default.jpg') }}" alt=""/>
                        <h2></h2>
                        <p>Responsable financier</p>
                        <ul>
                            <li><a href="tel:+00 000 000 000"><i class="fa fa-phone"></i>+00 000 000 000</a></li>
                            <li><a href="mailto:contact@exemple.com"><i class="fa fa-envelope"></i> contact@exemple.com</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
<!-- Team Area End -->

@endsection 