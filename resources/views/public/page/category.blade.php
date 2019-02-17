@extends('public.layout.master')
@section('content')
@include('public.partials.breadcrumb', ['attribute' => $category->name])
<!-- Product Section Start -->
<div class="product-section section mt-90 mb-90">
    <div class="container">
        <div class="row">
           
            <div class="col-12">
                
                <div class="row mb-50">
                    <div class="col">

                        <!-- Shop Top Bar Start -->
                        <div class="shop-top-bar">

                            <div class="product-view-mode">
                                @if(count($products) > 0)
                                <h2><span>1 - {{count($products)}}</span><span> @lang('public.search.of') {{$products->total()}}</span> @lang('public.search.result') <span class="query">{{$category->name}}</span></h2>
                                @else
                                <h2 class="search-result">@lang('public.search.no') <span class="query">{{$query}}</span></h2>
                                @endif
                            </div>

                        </div><!-- Shop Top Bar End -->
                        
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

                                    <a href="{{route('public.category',$product->category_id )}}" class="cat">{{$product->categoryName}}</a>
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
                        <h3 class="text-danger no-product">@lang('public.content.noProduct')</h3>
                    @endif
                </div><!-- Shop Product Wrap End -->
                <div class="row mt-30">
                    <div class="col">
                        <ul class="pagination">
                    {{ $products->links('public.partials.pagination', ['paginator' => $products]) }}
                        </ul>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
</div><!-- Feature Product Section End -->
@endsection
