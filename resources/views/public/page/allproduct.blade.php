@extends('public.layout.master')
@section('content')
@include('public.partials.breadcrumb', ['attribute' => trans('public.header.category')])
<!-- Product Section Start -->
<div class="product-section section mt-90 mb-90">
    <div class="container">
        <div class="row">

            <div class="col-12">

                <div class="row mb-50">
                    <div class="col">
                        @include('public.partials.filter')
                        <div id="filter-place">
                            <p class="filter-list">Filter by:</p>   
                        </div>
                    </div>
                </div>
                <!-- Shop Product Wrap Start -->
                <!-- Shop Product Wrap Start -->
                <div class="shop-product-wrap grid row" id="filter-result">
                    @foreach($products as $product)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12 pb-30 pt-10">
                        <!-- Product Start -->
                        <div class="ee-product">
                            <!-- Image -->
                            <div class="image">
                                <a href="{{route('public.product', $product->id)}}" class="img"><img src="storage/product/{{$product->images->first()['name']}}" alt="Product Image"></a>

                                <div class="wishlist-compare">
                                    <a class="compare-page" data-product="{{$product->id}}" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
                                </div>

                                <a href="{{ route('public.cart') }}" id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->unit_price }}" data-quantity="{{ $product->quantity }}" data-image="{{$product->images->first()['name']}}" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('public.content.addToCart')</span></a>
                            </div>
                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="category-title">

                                    <a href="{{route('public.category',$product->category->id )}}" class="cat">{{$product->category->name}}</a>
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
                    <div class="row mt-30 pagination" id="pagination">
                        <div class="col">
                            {{ $products->links('public.partials.pagination', ['paginator' => $products]) }}
                        </div>
                    </div><!-- Shop Product Wrap End -->
                </div>
            </div>
        </div>
    </div>
</div><!-- Feature Product Section End -->
@endsection 