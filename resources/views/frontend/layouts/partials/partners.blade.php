<!-- All Patner Section Start -->
<div class="all-patner-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="sec-title">
                    <h1>Nos partenaires</h1>
                    <div class="border-shape"></div>
                </div>
                
                <div class="all-patner">
                    @foreach($partners ?? [] as $partner)
                        <div class="single-patner">
                            <a href="{{ $partner->url ?? '#' }}" target="_blank">
                                <img src="{{ asset('storage/partners/' . $partner->image) }}" alt="{{ $partner->name }}"/>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- All Patner Section End -->