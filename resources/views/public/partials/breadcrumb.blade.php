<!-- Page Banner Section Start -->
<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">
        <!-- Page Banner -->
        <div class="col-lg-4 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
                <div class="breadcrumb">
                    <ul>
                        <li><a href="/">@lang('public.header.home')</a></li>
                        <li><span>{{$attribute}}</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Banner -->
        <div class="col-lg-4 col-md-6 col-12 order-lg-1">
            <div class="banner"><a href="#"><img src="storage/slides/{{$slides->first()->name}}" alt="Banner"></a></div>
        </div>
        <!-- Banner -->
        <div class="col-lg-4 col-md-6 col-12 order-lg-3">
            <div class="banner"><a href="#"><img src="storage/slides/{{$slides->last()->name}}" alt="Banner"></a></div>
        </div>
    </div>
</div><!-- Page Banner Section End -->