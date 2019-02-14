@extends('public.layout.master')
@section('content')
@include('public.partials.breadcrumb', ['attribute' => trans('public.filter.title')])
<!-- Product Section Start -->
<div class="product-section section mt-90 mb-90">
    <div class="container">
        <div class="row">
           
            <div class="col-12">

                <div class="row mb-50">
                    <div class="col">
                         <!-- Shop Top Bar Start -->
                        <div class="shop-top-bar">
                           @include('public.partials.filter')
                           <div id="filter-place">
                               
                           </div>
                        </div>
                    </div>
                </div>
                <!-- Shop Product Wrap Start -->
                <!-- Shop Product Wrap Start -->
                <div class="shop-product-wrap grid row">
                    @if(count($products) > 0)
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

                                <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('public.content.addToCart')</span></a>

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

                                    <h5 class="price">{{$product->unit_price . " đ"}}</h5>
                                </div>

                            </div>

                        </div><!-- Product End -->
                    </div>
                    @endforeach
                    @else
                    <h2 class="search-result">@lang('public.search.no') <span class="query">{{$value}}</span></h2>
                    @endif
                </div><!-- Shop Product Wrap End -->

                <div class="row mt-30">
                    <div class="col">

                        <ul class="pagination">
                        @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            {{ $products->links('public.partials.pagination', ['paginator' => $products]) }}
                        @endif
                        </ul>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
</div><!-- Feature Product Section End -->
@endsection
