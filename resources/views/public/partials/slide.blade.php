@if ($banners->count() > 0)
<div class="hero-section section mb-30">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="hero-slider hero-slider-one">
                    @foreach($banners as $banner)
                    <div class="hero-item">
                        <div class="row align-items-center justify-content-between">
                            <div class="hero-image col">
                                <img src="storage/slides/{{$banner->name}}" alt="Hero Image" height="425">
                            </div>
                        </div>     
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
