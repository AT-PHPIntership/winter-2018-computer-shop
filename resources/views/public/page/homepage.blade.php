@extends('public.layout.master')
@section('content')
@include('public.partials.slide')
<!-- Feature Product Section Start -->
<div class="product-section section mb-70">

    <div class="container">
        @if(session('message'))
        <div class="col-12 alert alert-success">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>
            {{ session('message') }}
        </div>
        @endif
        <div class="row">
            <!-- Section Title Start -->
            <div class="col-12 mb-40">
                <div class="section-title-one" data-title="@lang('public.content.featured')">
                    <h1>@lang('public.content.featured')</h1>
                </div>
            </div>
            <!-- Section Title End -->
            <!-- Product Tab Content Start -->
            <div class="col-12">
                <div class="tab-content">
                    <!-- Tab Pane Start -->
                    <div class="tab-pane fade show active" id="tab-one">
                        <!-- Product Slider Wrap Start -->
                        <div class="product-slider-wrap product-slider-arrow-one">
                            <!-- Product Slider Start -->
                            <div class="product-slider product-slider-4">
                                @foreach($feature as $product)
                                <div class="col pb-20 pt-10">
                                    <!-- Product Start -->
                                    <div class="ee-product">
                                        <!-- Image -->
                                        <div class="image">
                                            <a href="{{route('public.product', $product->id)}}" class="img"><img src="storage/product/{{$product->images->pluck('name')->first()}}" alt="Product Image"></a>
                                            <div class="wishlist-compare">
                                                <a class="compare-page" data-product="{{$product->id}}" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
                                            </div>
                                            <a href="{{ route('public.cart') }}" id="{{ $product->id }}" data-name="{{ $product->name }}" data-quantity="{{ $product->quantity }}" data-price="{{ $product->promotions->count() > 0 ? ($product->unit_price - ($product->unit_price * $product->promotions->pluck('percent')->first()/100))  : $product->unit_price }}" data-image="{{$product->images->pluck('name')->first()}}" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('public.content.addToCart')</span></a>
                                        </div>
                                        <!-- Content -->
                                        <div class="content">
                                            <!-- Category & Title -->
                                            <div class="category-title">
                                                <a href="{{route('public.category', $product->category_id)}}" class="cat">{{$product->category->name}}</a>
                                                <h5 class="title"><a href="{{route('public.product', $product->id)}}">{{$product->name}}</a></h5>
                                            </div>
                                            <!-- Price & Ratting -->
                                            <div class="price-ratting">
                                            @if ($product->promotions->count() > 0)
                                                <h5 class="price"><span class="old">{{number_format($product->unit_price ,0,",",".") . ' đ'}}</span>{{number_format($product->unit_price - (($product->unit_price * $product->promotions->pluck('percent')->first())/100),0,",",".") . ' đ'}}</h5>&nbsp;<span class="label-sale">{{$product->promotions->pluck('percent')->first() . '%'}}</span>
                                            @else 
                                                <h5 class="price">{{number_format($product->unit_price ,0,",",".") . ' đ'}}</h5>
                                            @endif
                                            </div>
                                        </div>
                                    </div><!-- Product End -->
                                </div>
                                @endforeach
                            </div><!-- Product Slider End -->
                        </div><!-- Product Slider Wrap End -->
                    </div><!-- Tab Pane End -->
                </div>
            </div><!-- Product Tab Content End -->
        </div>
    </div>
</div><!-- Feature Product Section End -->
<!-- Best Sell Product Section Start -->
<div class="product-section section mb-60">
    <div class="container">
        <div class="row">

            <!-- Section Title Start -->
            <div class="col-12 mb-40">
                <div class="section-title-one" data-title="@lang('public.content.bestseller')">
                    <h1>@lang('public.content.bestseller')</h1>
                </div>
            </div><!-- Section Title End -->

            <div class="col-12">
                <div class="row">
                    @foreach($bestSeller as $product)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12 pb-30 pt-10">
                        <!-- Product Start -->
                        <div class="ee-product">

                            <!-- Image -->
                            <div class="image">

                                <a href="{{route('public.product', $product->id)}}" class="img"><img src="storage/product/{{$product->images->pluck('name')->first()}}" alt="Product Image"></a>

                                <div class="wishlist-compare">
                                    <a class="compare-page" data-product="{{$product->id}}" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
                                </div>

                                <a href="{{ route('public.cart') }}" id="{{ $product->id }}" data-name="{{ $product->name }}" data-quantity="{{ $product->quantity }}" data-price="{{ $product->unit_price }}" data-image="{{$product->images->pluck('name')->first()}}" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('public.content.addToCart')</span></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="category-title">

                                    <a href="{{route('public.category', $product->category_id)}}" class="cat">{{$product->category->name}}</a>
                                    <h5 class="title"><a href="{{route('public.product', $product->id)}}">{{$product->name}}</a></h5>

                                </div>

                                <!-- Price & Ratting -->
                                <div class="price-ratting">

                                    @if ($product->promotions->count() > 0)
                                        <h5 class="price"><span class="old">{{number_format($product->unit_price ,0,",",".") . ' đ'}}</span>{{number_format($product->unit_price - (($product->unit_price * $product->promotions->pluck('percent')->first())/100),0,",",".") . ' đ'}}</h5>&nbsp;<span class="label-sale">{{$product->promotions->pluck('percent')->first() . '%'}}</span>
                                    @else 
                                        <h5 class="price">{{number_format($product->unit_price ,0,",",".") . ' đ'}}</h5>
                                    @endif

                                </div>

                            </div>

                        </div><!-- Product End -->
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div><!-- Best Sell Product Section End -->
<!-- New Arrival Product Section Start -->
<div class="product-section section mb-60">
    <div class="container">
        <div class="row">
            <!-- Section Title Start -->
            <div class="col-12 mb-40">
                <div class="section-title-one" data-title="@lang('public.content.newArrival')">
                    <h1>@lang('public.content.newArrival')</h1>
                </div>
            </div><!-- Section Title End -->
            <div class="col-12">
                <div class="row">
                    @foreach($newArrival as $product)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12 pb-30 pt-10">
                        <!-- Product Start -->
                        <div class="ee-product">
                            <!-- Image -->
                            <div class="image">
                                <a href="{{route('public.product', $product->id)}}" class="img"><img src="storage/product/{{$product->images->pluck('name')->first()}}" alt="Product Image"></a>
                                <div class="wishlist-compare">
                                    <a class="compare-page" data-product="{{$product->id}}" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
                                </div>
                                <a href="{{ route('public.cart') }}" id="{{ $product->id }}" data-name="{{ $product->name }}" data-quantity="{{ $product->quantity }}" data-price="{{ $product->unit_price }}" data-image="{{$product->images->pluck('name')->first()}}" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('public.content.addToCart')</span></a>
                            </div>
                            <!-- Content -->
                            <div class="content">
                                <!-- Category & Title -->
                                <div class="category-title">
                                    <a href="{{route('public.category', $product->category_id)}}" class="cat">{{$product->category->name}}</a>
                                    <h5 class="title"><a href="{{route('public.product', $product->id)}}">{{$product->name}}</a></h5>
                                </div>
                                <!-- Price & Ratting -->
                                <div class="price-ratting">
                                    @if ($product->promotions->count() > 0)
                                        <h5 class="price"><span class="old">{{number_format($product->unit_price ,0,",",".") . ' đ'}}</span>{{number_format($product->unit_price - (($product->unit_price * $product->promotions->pluck('percent')->first())/100),0,",",".") . ' đ'}}</h5>&nbsp;<span class="label-sale">{{$product->promotions->pluck('percent')->first() . '%'}}</span>
                                    @else 
                                        <h5 class="price">{{number_format($product->unit_price ,0,",",".") . ' đ'}}</h5>
                                    @endif
                                </div>
                            </div>
                        </div><!-- Product End -->
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div><!-- New Arrival Product Section End -->
@endsection 