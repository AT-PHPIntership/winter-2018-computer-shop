@extends('public.layout.master')
@section('content')
@include('public.partials.breadcrumb', ['attribute' => $products->name])
<!-- Single Product Section Start -->
<div class="product-section section mt-90 mb-90">
    <div class="container">
        
        <div class="row mb-90">
                    
            <div class="col-lg-6 col-12 mb-50">
                @foreach($products->images as $image)
              <div class="image-item" data-id="{{$image->id}}">
                      <a href="storage/product/{{$image->name}}" data-lightbox="product">
                         <img src="storage/product/{{$image->name}}" width='250' height='150'>
                     </a>
                </div>
                @endforeach

            </div>
                    
            <div class="col-lg-6 col-12 mb-50">

                <!-- Content -->
                <div class="single-product-content">

                    <!-- Category & Title -->
                    <div class="head-content">
                        <div class="category-title">
                            <a href="{{route('public.category',$products->category['id'])}}" class="cat">{{$products->category['name']}}</a>
                            <h5 class="title">{{$products->name}}</h5>
                        </div>

                        <h5 class="price">{{$products->unit_price . ' đ'}}</h5>

                    </div>

                    <div class="single-product-description">

                        <div class="desc">
                            <p>{!!$products->description!!}</p>
                        </div>
                        
                        <span class="availability">Availability: <span>@if($products->quantity > 0)In Stock @else Out of Stock @endif</span></span>
                        
                        <div class="quantity-colors">
                            
                            <div class="quantity">
                                <h5>Quantity</h5>
                                <div class="pro-qty"><input type="text" value="1"></div>
                            </div>                                                  
                            
                        </div> 

                        <div class="actions">

                            <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('public.content.addToCart')</span></a>

                            <div class="wishlist-compare">
                                <a class="compare-page" data-product="{{$products->id}}" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
                            </div>

                        </div>
                        
                    </div>

                </div>

            </div>
            
        </div>
        
        <div class="row">
            
            <div class="col-lg-10 col-12 ml-auto mr-auto">
                
                <ul class="single-product-tab-list nav">
                    <li><a href="#product-description" class="active" data-toggle="tab" >description</a></li>
                    <li><a href="#product-specifications" data-toggle="tab" >specifications</a></li>
                    <li><a href="#product-reviews" data-toggle="tab" >reviews</a></li>
                </ul>
                
                <div class="single-product-tab-content tab-content">
                    <div class="tab-pane fade show active" id="product-description">
                        
                        <div class="row">
                            <div class="single-product-description-content col-lg-8 col-12">
                                {!!$products->description!!}
                            </div>
                        </div>
                        
                    </div>
                    <div class="tab-pane fade" id="product-specifications">
                        <div class="single-product-specification">
                            <ul>
                                @foreach($products->accessories as $accessory)
                                <li>{{$accessory->name}}</li>
                               @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="product-reviews">
                       
                        <div class="product-ratting-wrap">

                            <div class="rattings-wrapper">
                            
                                <div class="sin-rattings">
                                    <div class="ratting-author">
                                        <h3>Cristopher Lee</h3>
                                    </div>
                                    <p>enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia res eos qui ratione voluptatem sequi Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci veli</p>
                                </div>
                    
                                
                            </div>
                            <div class="ratting-form-wrapper fix">
                                <h3>Add your Comments</h3>
                                <form action="#">
                                    <div class="ratting-form row">
                                        
                                        <div class="col-md-6 col-12 mb-15">
                                            <label for="name">Name:</label>
                                            <input id="name" placeholder="Name" type="text">
                                        </div>
                                        <div class="col-md-6 col-12 mb-15">
                                            <label for="email">Email:</label>
                                            <input id="email" placeholder="Email" type="text">
                                        </div>
                                        <div class="col-12 mb-15">
                                            <label for="your-review">Your Review:</label>
                                            <textarea name="review" id="your-review" placeholder="Write a review"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <input value="add review" type="submit">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
            
        </div>
        
    </div>
</div><!-- Single Product Section End -->

<!-- Related Product Section Start -->
<div class="product-section section mb-70">
    <div class="container">
        <div class="row">
            
            <!-- Section Title Start -->
            <div class="col-12 mb-40">
                <div class="section-title-one" data-title="@lang('public.content.related')"><h1>@lang('public.content.related')</h1></div>
            </div><!-- Section Title End -->
            
            <!-- Product Tab Content Start -->
            <div class="col-12"> 
                <!-- Product Slider Wrap Start -->
                <div class="product-slider-wrap product-slider-arrow-one">
                    <div class="product-slider product-slider-4"> 
                        @foreach($relatedProduct as $product)
                        <div class="col pb-20 pt-10">
                            <!-- Product Start -->
                            <div class="ee-product">

                                <!-- Image -->
                                <div class="image">

                                    <a href="product/{{$product->id}}" class="img"><img src="storage/product/{{$product->images->first()['name']}}" alt="Product Image"></a>

                                    <div class="wishlist-compare">
                                        <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
                                    </div>

                                    <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('public.content.addToCart')</span></a>

                                </div>

                                <!-- Content -->
                                <div class="content">

                                    <!-- Category & Title -->
                                    <div class="category-title">

                                        <a href="category/{{$product->categoryId}}" class="cat">{{$product->categoryName}}</a>
                                        <h5 class="title"><a href="product/{{$product->id}}">{{$product->name}}</a></h5>

                                    </div>

                                    <!-- Price & Ratting -->
                                    <div class="price-ratting">

                                    <h5 class="price">{{$product->unit_price . ' đ'}}</h5>

                                    </div>

                                </div>

                            </div><!-- Product End -->
                        </div>
                        @endforeach
                    </div>
                </div><!-- Product Slider Wrap End -->
            </div><!-- Product Tab Content End -->
            
        </div>
    </div>
</div><!-- Related Product Section End -->
@endsection
