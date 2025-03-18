@extends('frontend.layouts.master')

@section('title', 'Notre équipe')

@section('content')
 
<!-- BREADCRUMBS SECTION START -->
<section class="ul-breadcrumb ul-section-spacing">
    <div class="ul-container">
        <h2 class="ul-breadcrumb-title">Notre équipe</h2>
        <ul class="ul-breadcrumb-nav">
            <li><a href="{{ url('/') }}">Accueil</a></li>
            <li><span class="separator"><i class="flaticon-right"></i></span></li>
            <li>Notre équipe</li>
        </ul>
    </div>
</section>
<!-- BREADCRUMBS SECTION END -->

<!-- TEAM SECTION START -->
<section class="ul-team ul-inner-team ul-section-spacing">
    <div class="ul-container">
        @if(isset($equipeCategories) && count($equipeCategories) > 0)
            @foreach($equipeCategories as $category)
                <div class="section-header mb-5">
                    <h2 class="ul-section-title">{{ $category->title }}</h2>
                </div>
                
                <div class="row row-cols-md-4 row-cols-sm-3 row-cols-2 row-cols-xxs-1 ul-team-row justify-content-center mb-5">
                    @php
                        $categoryMembers = $equipes->where('equipe_category_id', $category->id);
                    @endphp
                    @if($categoryMembers->count() > 0)
                        @foreach($categoryMembers as $member)
                            <!-- single member -->
                            <div class="col">
                                <div class="ul-team-member">
                                    <div class="ul-team-member-img">
                                        @if($member->image)
                                            <img src="{{ asset('storage/equipes/' . $member->image) }}" alt="{{ $member->name }}">
                                        @else
                                            <img src="{{ asset('img/equipe/default.jpg') }}" alt="{{ $member->name }}">
                                        @endif
                                        <div class="ul-team-member-socials">
                                            @if(isset($member->linkedin))
                                                <a href="{{ $member->linkedin }}" target="_blank"><i class="flaticon-linkedin-big-logo"></i></a>
                                            @endif
                                            @if($member->phone)
                                                <a href="tel:{{ $member->phone }}"><i class="flaticon-telephone-call"></i></a>
                                            @endif
                                            @if($member->email)
                                                <a href="mailto:{{ $member->email }}"><i class="flaticon-email"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ul-team-member-info">
                                        <h3 class="ul-team-member-name">{{ $member->name }}</h3>
                                        <p class="ul-team-member-designation">{{ $member->position }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <p class="text-center">Aucun membre trouvé dans cette catégorie.</p>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</section>
<!-- TEAM SECTION END -->

<!-- DYNAMIC SECTIONS START -->
@if(isset($pageSections) && count($pageSections) > 0)
    @foreach($pageSections as $pageSection)
        <x-dynamic-section :pageSection="$pageSection" />
    @endforeach
@endif
<!-- DYNAMIC SECTIONS END -->

@endsection 