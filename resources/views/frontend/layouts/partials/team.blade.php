<!-- TEAM SECTION START -->
<section class="ul-team ul-section-spacing">
    <div class="ul-container">
        <!-- Heading -->
        <div class="ul-section-heading justify-content-between">
            <div class="left">
                <span class="ul-section-sub-title">Notre équipe</span>
                <h2 class="ul-section-title">Nous sommes une équipe de professionnels</h2>
            </div>
            <div>
                <a href="{{ route('team') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Voir tous nos membres</a>
            </div>
        </div>

        <div class="row row-cols-md-4 row-cols-sm-3 row-cols-2 row-cols-xxs-1 ul-team-row justify-content-center">
            <!-- single member -->
            @if(isset($equipes) && $equipes->count() > 0)
                @foreach($equipes->take(4) as $member)
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
            @endif
        </div>
    </div>
</section>
<!-- TEAM SECTION END -->