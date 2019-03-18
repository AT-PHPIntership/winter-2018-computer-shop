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

                        <span class="availability">@lang('public.product.available.title') <span>@if($products->quantity > 0)@lang('public.product.available.in') @else @lang('public.product.available.out') @endif</span></span>

                        <div class="quantity-colors">

                            <div class="quantity"  {{ ($products->quantity > 0) ? ' ' : 'hidden'}}> 
                                <h5>@lang('public.product.quantity')</h5>
                                <div class="pro-qty"><input id="quantity-value" type="number" value="1"></div>
                            </div>

                        </div>

                        <div class="actions" {{ ($products->quantity > 0) ? ' ' : 'hidden'}}>

                            <a href="{{ route('public.cart') }}" id="{{ $products->id }}" data-name="{{ $products->name }}" data-price="{{ $products->unit_price }}" data-quantity="{{ $products->quantity }}" data-image="{{$products->images->first()['name']}}" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('public.content.addToCart')</span></a>

                            <div class="wishlist-compare">
                                <a class="compare-page" data-product="{{$products->id}}" data-tooltip="@lang('public.profile.compare')"><i class="ti-control-shuffle"></i></a>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-lg-10 col-12 ml-auto mr-auto">

                <ul class="single-product-tab-list nav">
                    <li><a href="#product-description" class="active" data-toggle="tab">@lang('public.product.desc')</a></li>
                    <li><a href="#product-specifications" data-toggle="tab">@lang('public.product.spec')</a></li>
                    <li><a href="#product-reviews" data-toggle="tab">@lang('public.product.review')</a></li>
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

                            <div class="ratting-form-wrapper fix">
                                <h3>@lang('public.product.title')</h3>
                                <div class="ratting-form row">
                                    <div class="col-12 mb-15">
                                        <textarea id='comment-text' name="review" placeholder="@lang('public.product.placeholder')"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <input id='comment-button' {{(Auth::user()) ? 'data-user=' .Auth::user()->id : ''}} data-product='{{$products->id}}' data-token="{{ csrf_token() }}" value="@lang('public.product.button')" type="submit">
                                    </div>
                                </div>
                                <ol class="comment-list" id="commentList">
                                    @foreach ($products->comments as $comment)
                                    <li class="comment-border" data-id='{{$comment->id}}'>
                                        <article id="{{$comment->id}}">
                                            <div class="comment-des">
                                                <div class="comment-by">
                                                    @if(!is_null($comment->created_at))
                                                    <p class="author"><strong>{{$comment->user->name}}<span class="comment-time">{{$comment->created_at->diffForHumans()}}</span></strong></p>
                                                    @else
                                                    <p class="author"><strong>{{$comment->user->name}}<span class="comment-time">@lang('public.product.time.no')</span></strong></p>
                                                    @endif
                                                    <span class="reply"><a class="add-reply" id='{{$comment->id}}'>@lang('public.product.reply')</a></span>
                                                </div>
                                                <section>
                                                    <p>{{$comment->content}}</p>
                                                </section>
                                            </div>
                                        </article>
                                        @foreach ($comment->childrens as $reply)
                                        <ol class="children" id="commentChildren">
                                            <li class="comment-border" data-id='{{$reply->id}}'>
                                                <article id="{{$reply->id}}">
                                                    <div class="comment-des">
                                                        <div class="comment-by">
                                                            <p class="author"><strong>{{$reply->user->name}}<span class="comment-time">{{$reply->created_at->diffForHumans()}}</span></strong></p>
                                                        </div>
                                                        <section>
                                                            <p>{{$reply->content}}</p>
                                                        </section>
                                                    </div>
                                                </article>
                                            </li>
                                        </ol>
                                        @endforeach
                                    </li>
                                    @endforeach
                                </ol>
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
                <div class="section-title-one" data-title="@lang('public.content.related')">
                    <h1>@lang('public.content.related')</h1>
                </div>
            </div><!-- Section Title End -->

            <!-- Product Tab Content Start -->
            <div class="col-12">
                <!-- Product Slider Wrap Start -->
                <div class="product-slider-wrap product-slider-arrow-one">
                    <div class="product-slider product-slider-4">
                        @foreach($relatedProduct as $product)
                        @if ($product->id != $products->id)
                        <div class="col pb-20 pt-10">
                            <!-- Product Start -->
                            <div class="ee-product">

                                <!-- Image -->
                                <div class="image">

                                    <a href="product/{{$product->id}}" class="img"><img src="storage/product/{{$product->images->first()['name']}}" alt="Product Image"></a>

                                    <div class="wishlist-compare">
                                        <a class="compare-page" data-product="{{$product->id}}" data-tooltip="@lang('public.profile.compare')"><i class="ti-control-shuffle"></i></a>
                                    </div>

                                    <a href="{{ route('public.cart') }}" id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->unit_price }}" data-quantity="{{ $product->quantity }}" data-image="{{$product->images->first()['name']}}" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('public.content.addToCart')</span></a>

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
                        @endif
                        @endforeach
                    </div>
                </div><!-- Product Slider Wrap End -->
            </div><!-- Product Tab Content End -->

        </div>
    </div>
</div><!-- Related Product Section End -->
@endsection 