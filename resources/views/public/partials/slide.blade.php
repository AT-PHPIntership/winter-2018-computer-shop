<!-- Hero Section Start -->
<div class="hero-section section mb-30">
    <div class="container">
        <div class="row">
            <div class="col">
                <!-- Hero Slider Start -->
                <div class="hero-slider hero-slider-one">
                    <!-- Hero Item Start -->
                    @foreach($saleOff as $product)
                    <div class="hero-item">
                        <div class="row align-items-center justify-content-between">
                            <!-- Hero Content -->
                            <div class="hero-content col-6">
                                <h3>@lang('public.slide.hurry')</h3>
                                <h2 class="font-weight-bold"><span>{{$product->name}}</span></h2>
                                <h2>@lang('public.slide.its') <span class="big font-weight-bold">29%</span> @lang('public.slide.off')</h2>
                                <a href="{{route('public.product', $product->id)}}">@lang('public.slide.get')</a>
                            </div>
                            <!-- Hero Image -->
                            <div class="hero-image col-6">
                               <img src="storage/product/{{$product->images->pluck('name')->first()}}" alt="Hero Image">
                            </div>
                        </div>     
                    </div><!-- Hero Item End -->
                    @endforeach

                </div><!-- Hero Slider End -->

            </div>
        </div>
    </div>
</div><!-- Hero Section End -->

<!-- Banner Section Start -->
<div class="banner-section section mb-60">
    <div class="container">
        <div class="row row-10">
            @foreach($banners as $banner)
            <!-- Banner -->
            <div class="col-md-6 col-12 mb-30">
                <div class="banner"><a href="#"><img src="storage/slide/{{$banner->name}}" alt="Banner"></a></div>
            </div>
            @endforeach
        </div>
    </div>
</div><!-- Banner Section End -->