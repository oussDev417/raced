@extends('frontend.layouts.master')

@section('title', 'Nous soutenir')

@section('content')	

<!-- BREADCRUMBS SECTION START -->
<section class="ul-breadcrumb ul-section-spacing">
    <div class="ul-container">
        <h2 class="ul-breadcrumb-title">Nous soutenir</h2>
        <ul class="ul-breadcrumb-nav">
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li><span class="separator"><i class="flaticon-right"></i></span></li>
            <li>Nous soutenir</li>
        </ul>
    </div>
</section>
<!-- BREADCRUMBS SECTION END -->

<!-- Donation Section Start -->
<section class="ul-donation-section ul-section-spacing">
    <div class="ul-container">
        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="ul-donation-intro">
                    <div class="ul-section-heading">
                        <div class="left">
                            <span class="ul-section-sub-title">Votre soutien compte</span>
                            <h2 class="ul-section-title">Nous soutenir</h2>
                            <p class="ul-section-descr">Votre participation, aussi modeste soit-elle, constitue le meilleur soutien pour la poursuite de nos projets.</p>
                        </div>
                    </div>
                    <div class="ul-donation-image">
                        <img src="https://images.unsplash.com/photo-1473594659356-a404044aa2c2?q=80&w=2072&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Donation" onerror="this.src='https://placehold.co/600x400?text=ONG+RACED'">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ul-donation-options">
                    <!-- Option 1 -->
                    <div class="ul-donation-option">
                        <div class="ul-donation-option-header">
                            <div class="ul-donation-option-icon">
                                <i class="fas fa-hand-holding-heart"></i>
                            </div>
                            <h3 class="ul-donation-option-title">Don sur le compte de RACED</h3>
                        </div>
                        <div class="ul-donation-option-content">
                            <p>Vous versez votre don sur le compte de l'ONG RACED:</p>
                            <div class="ul-donation-account">
                            @if(isset($settings) && $settings->bank_number)
                                <span> N° {{ $settings->bank_number }}</span>
                            @endif
                                
                            </div>
                            <p>Votre participation, aussi modeste soit-elle, constitue le meilleur soutien pour la poursuite de nos projets.</p>
                            <p>Vous bénéficiez d'une déduction fiscale à partir de 40 euros de dons par an. Une attestation fiscale vous sera envoyée dès votre premier trimestre suivant l'année de votre don/vos dons.</p>
                        </div>
                    </div>

                    <!-- Option 2 -->
                    <div class="ul-donation-option">
                        <div class="ul-donation-option-header">
                            <div class="ul-donation-option-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <h3 class="ul-donation-option-title">Lever de fonds pour la construction du siège</h3>
                        </div>
                        <div class="ul-donation-option-content">
                            <p>Vous pouvez contribuer à la construction de notre siège en faisant un don via le bouton suivant :</p>
                            <div class="ul-donation-button-wrapper">
                                <a href="#" class="ul-btn">
                                    Faire un don <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                            <p>Chaque contribution, aussi modeste soit-elle, nous rapproche de notre objectif.</p>
                        </div>
                    </div>

                    <!-- Option 3 -->
                    <div class="ul-donation-option">
                        <div class="ul-donation-option-header">
                            <div class="ul-donation-option-icon">
                                <i class="fas fa-sync-alt"></i>
                            </div>
                            <h3 class="ul-donation-option-title">Faire un ordre permanent</h3>
                        </div>
                        <div class="ul-donation-option-content">
                            <p>Un don, fait par ordre permanent ou par domiciliation, nous permet de planifier nos actions dans le moyen ou le long terme.</p>
                            <p>Pour vous, c'est la satisfaction de participer à nos actions dans la durée. C'est sortir d'une action de charité pour rentrer dans une véritable logique de développement durable.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Donation Section End -->

<!-- Donation Impact Section Start -->
<section class="ul-donation-impact ul-section-spacing" style="background-color: var(--ul-c4);">
    <div class="ul-container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="ul-section-heading">
                    <div class="left">
                        <span class="ul-section-sub-title">Impact de vos dons</span>
                        <h2 class="ul-section-title">Comment votre soutien fait la différence</h2>
                        <p class="ul-section-descr">Chaque euro compte et contribue directement à nos actions sur le terrain.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ul-bs-row">
            <div class="col-md-4">
                <div class="ul-impact-card">
                    <div class="ul-impact-card-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="ul-impact-card-title">Éducation</h3>
                    <p class="ul-impact-card-text">Votre don permet de financer des programmes éducatifs pour les jeunes défavorisés.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ul-impact-card">
                    <div class="ul-impact-card-icon">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h3 class="ul-impact-card-title">Développement</h3>
                    <p class="ul-impact-card-text">Nous mettons en place des projets de développement durable dans les communautés locales.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ul-impact-card">
                    <div class="ul-impact-card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="ul-impact-card-title">Communauté</h3>
                    <p class="ul-impact-card-text">Nous renforçons les liens communautaires et favorisons l'autonomisation des jeunes.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Donation Impact Section End -->
<!-- DYNAMIC SECTIONS START -->
@if(isset($pageSections) && count($pageSections) > 0)
    @foreach($pageSections as $pageSection)
        <x-dynamic-section :pageSection="$pageSection" />
    @endforeach
@endif
<!-- DYNAMIC SECTIONS END -->
<style>
/* Donation Page Styles */
.ul-donation-intro {
    padding-right: clamp(15px, 2.1vw, 40px);
}

.ul-donation-image {
    margin-top: clamp(20px, 2.1vw, 40px);
    border-radius: 20px;
    overflow: hidden;
}

.ul-donation-image img {
    width: 100%;
    border-radius: 20px;
    transition: transform 0.5s ease;
}

.ul-donation-image:hover img {
    transform: scale(1.03);
}

.ul-donation-options {
    display: flex;
    flex-direction: column;
    gap: clamp(20px, 2.1vw, 40px);
}

.ul-donation-option {
    background-color: var(--ul-gray3);
    border-radius: 20px;
    padding: clamp(20px, 2.1vw, 40px);
    transition: all 0.3s ease;
    border-left: 4px solid var(--ul-primary);
}

.ul-donation-option:hover {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transform: translateY(-5px);
}

.ul-donation-option-header {
    display: flex;
    align-items: center;
    gap: clamp(15px, 1.05vw, 20px);
    margin-bottom: clamp(15px, 1.05vw, 20px);
}

.ul-donation-option-icon {
    width: clamp(50px, 3.15vw, 60px);
    height: clamp(50px, 3.15vw, 60px);
    background-color: var(--ul-primary);
    color: var(--white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: clamp(20px, 1.26vw, 24px);
    flex-shrink: 0;
}

.ul-donation-option-title {
    font-family: var(--font-quicksand);
    font-weight: 700;
    font-size: clamp(18px, 1.26vw, 24px);
    color: var(--ul-black);
    margin-bottom: 0;
}

.ul-donation-option-content {
    color: var(--ul-p);
}

.ul-donation-option-content p {
    margin-bottom: clamp(10px, 0.79vw, 15px);
}

.ul-donation-option-content p:last-child {
    margin-bottom: 0;
}

.ul-donation-account {
    background-color: var(--white);
    border-radius: 10px;
    padding: clamp(10px, 1.05vw, 20px);
    margin: clamp(10px, 1.05vw, 20px) 0;
    text-align: center;
    font-weight: 700;
    font-size: clamp(16px, 1.05vw, 20px);
    color: var(--ul-primary);
    border: 1px dashed var(--ul-primary);
}

.ul-donation-button-wrapper {
    margin: clamp(15px, 1.05vw, 20px) 0;
    text-align: center;
}

/* Impact Section Styles */
.ul-impact-card {
    background-color: var(--white);
    border-radius: 20px;
    padding: clamp(25px, 2.1vw, 40px);
    text-align: center;
    height: 100%;
    transition: all 0.3s ease;
}

.ul-impact-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.ul-impact-card-icon {
    width: clamp(70px, 4.2vw, 80px);
    height: clamp(70px, 4.2vw, 80px);
    background-color: var(--ul-primary);
    color: var(--white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: clamp(24px, 1.58vw, 30px);
    margin: 0 auto clamp(15px, 1.05vw, 20px);
}

.ul-impact-card-title {
    font-family: var(--font-quicksand);
    font-weight: 700;
    font-size: clamp(18px, 1.26vw, 24px);
    color: var(--ul-black);
    margin-bottom: clamp(10px, 0.79vw, 15px);
}

.ul-impact-card-text {
    color: var(--ul-p);
    margin-bottom: 0;
}
</style>


@endsection