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

                            <!-- Product View Mode -->
                            <div class="product-view-mode">
                                <a class="active" href="#" data-target="grid"><i class="fa fa-th"></i></a>
                                <a href="#" data-target="list"><i class="fa fa-list"></i></a>
                            </div>

                            <!-- Product Showing -->
                            <div class="product-showing">
                                <p>Showing</p>
                                <select name="showing" class="nice-select">
                                    <option value="1">8</option>
                                    <option value="2">12</option>
                                    <option value="3">16</option>
                                    <option value="4">20</option>
                                    <option value="5">24</option>
                                </select>
                            </div>

                            <!-- Product Short -->
                            <div class="product-short">
                                <p>Short by</p>
                                <select name="sortby" class="nice-select">
                                    <option value="trending">Trending items</option>
                                    <option value="sales">Best sellers</option>
                                    <option value="rating">Best rated</option>
                                    <option value="date">Newest items</option>
                                    <option value="price-asc">Price: low to high</option>
                                    <option value="price-desc">Price: high to low</option>
                                </select>
                            </div>

                            <!-- Product Pages -->
                            <div class="product-pages">
                                <p>Pages 1 of 25</p>
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
                                <a href="{{ route('public.cart') }}" id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->unit_price }}" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('public.content.addToCart')</span></a>

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
