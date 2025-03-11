@extends('frontend.layouts.master')

@section('title', 'À propos')

@section('content')

<!-- Page Heading Section Start -->	
<div class="pagehding-sec">
    <div class="images-overlay"></div>		
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-heading">
                    <h1>À propos de nous</h1>
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
                        <li><a href="#">À propos</a></li>
                    </ul>
                </div>
            </div>	
        </div>
    </div>
</div>
<!-- Page Heading Section End -->

<!-- How To Help Section Start -->	
<div class="how-to-help-sec pt-100 pb-70">
    <div class="how-to-help-sec-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="sec-title">
                    <h1>@if(isset($about) && $about->title){{ $about->title }}@else Historique @endif</h1>
                    <div class="border-shape"></div>
                </div>										
                <div class="how-to-help-box">
                    <div class="zecounting_sl" style="text-align: justify;">
                        @if(isset($about) && $about->description)
                            {!! $about->description !!}
                        @else
                            Carrefour Jeunesse Afrique a été initiée depuis en 2011 de la sensibilité d'un homme face aux souffrances des enfants, des adolescents et jeunes surtout des filles qui avaient beaucoup de difficulté à se scolariser, à aller en apprentissage et à se construire un avenir meilleur. La majorité de ses enfants côtoyés décrochaient les écoles et études scolaires faute de moyen des parents. D'autres abandonnaient les apprentissages parce que n'ayant pas payé les frais de contrat de formation professionnelle.
                            <br> <br>
                            En réalité, l'épanouissement socio-éducatif des enfants posait problème et leur avenir semble être hypothéqué. Sensible à ce tableau lugubre de la situation de ces cibles dans la commune et sensible au non-respect de ses droits de l'enfant et des filles surtout, un certain nombre de jeunes adultes ont décidé de mettre sur pieds une association pour donner de la joie à ces enfants, contribuer à leur épanouissement et surtout les accompagner avec leurs maigres ressources pour les autonomiser, leur donner de l'espoir et ce faisant garantir leur avenir.
                            <br>
                            C'est ainsi que ce groupe de personnes ont pris sur eux l'initiative et l'engagement de créer cette organisation dénommée « Carrefour Jeunesse Afrique (CJA) ». Ainsi est né ce centre socio-éducatif d'aide à l'enfance et à la jeunesse en 2011. Depuis cette époque, deux espaces « découvertes » étaient opérationnels. Devant le succès inattendu du projet, 13 autres ateliers ont vu le jour au fil des années…
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>		
<!-- How To Help Section End -->		

<!-- Event Section Start -->	
<div class="event-sec pt-100 pb-70">
    <div class="container">
        <div class="row">						
            <div class="col-md-6">
                <div class="faq-sec">
                    <div class="sec-title">
                        <h1>Nos Visions</h1>
                        <div class="border-shape"></div>
                    </div>				
                    <div class="how-to-help-box">
                        <div class="counting_sl" style="text-align: justify;">
                            <style>
                                .counting_sl ul {
                                    list-style-type: disc;
                                    padding-left: 20px;
                                    padding-bottom: 20px;
                                }

                                .counting_sl ul li {
                                    font-weight: bold;
                                }
                            </style>
                            @if(isset($about) && $about->vision)
                                {!! $about->vision !!}
                            @else
                                La vision générale de Carrefour Jeunesse Afrique est de diminuer substantiellement les inégalités des chances et d'accroitre la capacité d'épanouissement des enfants surtout les filles, d'émancipation des adolescents et jeunes. Les quatre piliers développés par l'ONG-CJA contribuent à l'atteinte de la vision qui est de faire de Carrefour Jeunesse Afrique à Comé un service d'aide à la jeunesse en oeuvrant à ces cibles des activités et des informations leur permettant de développer leur plein potentiel et de pouvoir se développer dans un environnement favorable. De façon détaillée, il s'agit de : 
                                <ul>
                                    <li>
                                        Concrétiser les projets selon ses 4 piliers d'interventions ;
                                    </li>
                                    <li>
                                        Diminuer les inégalités sociales constatée ; 
                                    </li>
                                    <li>
                                        Donner de la visibilité aux actions de CJA ;
                                    </li>
                                    <li>
                                        Prendre en charge les jeunes de façon plus globale, à la fois sociale éducative, formative, citoyenne et interculturelle dans leur milieu de vie ;
                                    </li>
                                    <li>
                                        Pérenniser les actions du centre par des organismes gouvernementaux et non gouvernementaux, avec des appuis institutionnels en équipements, en matériels, en ressources humaines, logistiques et financières pour renforcer les interventions de l'ONG-CJA et sa performance
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>					
                </div>	
            </div>	
            <div class="col-md-6">
                <div class="event-title">
                    <img src="{{ asset($about->main_image ?? 'img/enfant-maire.jpeg') }}" alt="Vision"/>
                </div>
            </div>
        </div>					
    </div>
</div>
<!-- Event Section End -->

<!-- Event Section Start -->	
<div class="event-sec pt-100 pb-70">
    <div class="container">
        <div class="row">	
            <div class="col-md-6">
                <div class="zevent-title">
                    <div class="sec-title">
                        <h1>Nos Missions</h1>
                        <div class="border-shape"></div>
                    </div>		
                    <img src="{{ asset($about->secondary_image ?? 'img/luc-work.jpeg') }}" alt="Mission"/>
                </div>
            </div>					
            <div class="col-md-6">
                <div class="faq-sec">
                    <div class="how-to-help-box">
                        <div class="counting_sl" style="text-align: justify;">
                            <style>
                                .counting_sl ul {
                                    list-style-type: disc;
                                    padding-left: 20px;
                                    padding-bottom: 20px;
                                }

                                .counting_sl ul li {
                                    font-weight: bold;
                                }
                            </style>
                            @if(isset($about) && $about->mission)
                                {!! $about->mission !!}
                            @else
                                La ligne que s'est donnée Carrefour Jeunesse Afrique est d'offrir une meilleure égalité des chances à travers des actions de prévention et d'émancipation. L'ONG Carrefour Jeunesse Afrique s'aligne sur les orientations mondiales de développement (l'Agenda 2030 et les Objectifs de Développement Durable, ODD), continentales (Agenda 2063, l'Afrique que nous voulons), nationales (le Plan National de Développement, PND-2025 ;le Programme d'Action du Gouvernement, PAG 2016-2021) et Communales (Plan de Développement de la Commune de Comé, 3ème génération, 2017-2022 Sa mission est de :
                                <ul>
                                    <li>
                                        Promouvoir des activités sportives, ludiques, éducatives, culturelles ;
                                    </li>
                                    <li>
                                        Accompagner toutes les initiatives visant à assurer l'autodétermination de la jeunesse ; 
                                    </li>
                                    <li>
                                        Contribuer au brassage interculturel entre les jeunes africains et européens ;
                                    </li>
                                    <li>
                                        Œuvrer pour l'éducation pour tous et en particulier celle des enfants surtout des filles ;
                                    </li>
                                    <li>
                                        Œuvrer pour la promotion des droits de la femme et leur épanouissement ;
                                    </li>
                                    <li>
                                        développer une solidarité communautaire dans la protection de l'environnement ;
                                    </li>
                                    <li>
                                        promouvoir le développement rural à travers la production et la transformation agro-alimentaire ;
                                    </li>
                                    <li>
                                        accompagner les collectivités dans la mise en œuvre du développement local et la coopération décentralisée Sud Sud. Nord Sud ;
                                    </li>
                                    <li>
                                        promouvoir et développer le volontariat ;
                                    </li>
                                    <li>
                                        Promouvoir le droit à la santé sexuelle et reproductives des adolescent-e-s et jeunes ;
                                    </li>
                                    <li>
                                        promouvoir la santé pour tous et l'égalité des sexes ;
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>					
                </div>	
            </div>
        </div>					
    </div>
</div>
<!-- Event Section End -->

<!-- Values Section Start -->
<div class="how-to-help-sec pt-100 pb-70">
    <div class="how-to-help-sec-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="sec-title">
                    <h1>Nos Valeurs</h1>
                    <div class="border-shape"></div>
                </div>
            </div>
        </div>
        <div class="row">
            @if(isset($about) && $about->values)
                <style>
                    .value-card {
                        background-color: #fff;
                        border-radius: 8px;
                        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                        padding: 20px;
                        margin-bottom: 20px;
                        height: 100%;
                        transition: transform 0.3s ease;
                    }
                    .value-card:hover {
                        transform: translateY(-5px);
                    }
                    .value-card h4 {
                        color: #042a41;
                        margin-bottom: 15px;
                        font-weight: 600;
                    }
                    .value-card p {
                        color: #042a41;
                    }
                    .value-icon {
                        font-size: 40px;
                        color: #8DC63F;
                        margin-bottom: 15px;
                    }
                </style>
                @php
                    $valuesList = strip_tags($about->values, '<li>');
                    preg_match_all('/<li>(.*?)<\/li>/s', $valuesList, $matches);
                    $values = $matches[1] ?? [];
                @endphp
                
                @foreach($values as $index => $value)
                    <div class="col-md-3 col-sm-6">
                        <div class="value-card">
                            <div class="value-icon">
                                <i class="fa fa-star"></i>
                            </div>
                            <h4>{{ $value }}</h4>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
<!-- Values Section End -->

@endsection 