@extends('public.layout.master')
@section('content')
@include('public.partials.breadcrumb', ['attribute' => trans('public.header.compare')])
<!-- Compare Page Start -->
<div class="page-section section mt-90 mb-90">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="#">

                    <!-- Compare Table -->
                    <div class="compare-table table-responsive">
                        <table class="table mb-0">
                            <tbody id="compare-product">
                                <tr>
                                    <td class="first-column">@lang('public.compare.product')</td>
                                    <td class="product-image-title">
                                        @foreach($firstProduct as $product)
                                        <a href="#" class="image"><img src="storage/product/{{$product->images->first()->name}}" alt="Compare Product" width="300" height="150"></a>
                                        <a href="category/{{$product->category->id}}" class="category">{{$product->category->name}}</a>
                                        <a href="product/{{$product->id}}" class="title">{{$product->name}}</a>
                                        @endforeach
                                    </td>
                                    <td class="product-image-title">
                                        @foreach($secondProduct as $product)
                                        <a href="#" class="image"><img src="storage/product/{{$product->images->first()->name}}" alt="Compare Product" width="300" height="150"></a>
                                        <a href="category/{{$product->category->id}}" class="category">{{$product->category->name}}</a>
                                        <a href="product/{{$product->id}}" class="title">{{$product->name}}</a>
                                        @endforeach
                                    </td>

                                </tr>
                                <tr>
                                    <td class="first-column">@lang('public.compare.description')</td>
                                    @foreach($firstProduct as $product)
                                    <td class="pro-desc">
                                        <p>{!!$product->description!!}</p>
                                    </td>
                                    @endforeach
                                    @foreach($secondProduct as $product)
                                    <td class="pro-desc">
                                        <p>{!!$product->description!!}</p>
                                    </td>
                                    @endforeach

                                </tr>
                                <tr>
                                    <td class="first-column">@lang('public.compare.price')</td>
                                    @foreach($firstProduct as $product)
                                    <td class="pro-price">{{$product->unit_price . ' đ'}}</td>
                                    @endforeach
                                    @foreach($secondProduct as $product)
                                    <td class="pro-price">{{$product->unit_price . ' đ'}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td class="first-column">@lang('public.compare.addToCart')</td>
                                    @foreach($firstProduct as $product)
                                    <td class="pro-addtocart"><a href="{{ route('public.cart') }}" id="{{ $product->id }}" data-name="{{ $product->name }}" data-quantity="{{ $product->quantity }}" data-price="{{ $product->promotions->count() > 0 ? ($product->unit_price - ($product->unit_price * $product->promotions->pluck('percent')->first()/100))  : $product->unit_price }}" data-image="{{$product->images->pluck('name')->first()}}" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('public.content.addToCart')</span></a></td>
                                    @endforeach
                                    @foreach($secondProduct as $product)
                                    <td class="pro-addtocart"><a href="{{ route('public.cart') }}" id="{{ $product->id }}" data-name="{{ $product->name }}" data-quantity="{{ $product->quantity }}" data-price="{{ $product->promotions->count() > 0 ? ($product->unit_price - ($product->unit_price * $product->promotions->pluck('percent')->first()/100))  : $product->unit_price }}" data-image="{{$product->images->pluck('name')->first()}}" class="add-to-cart"><i class="ti-shopping-cart"></i><span>@lang('public.content.addToCart')</span></a></td>
                                    @endforeach

                                </tr>
                                <tr>
                                    <td class="first-column">@lang('public.compare.delete')</td>
                                    @for($i = 0; $i <= count($firstProduct); $i++) <td class="pro-remove"><button type="button" data-id="{{$i}}" class="delete-compare"><i class="fa fa-trash-o"></i></button></td>
                                        @endfor
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
<!-- Compare Page End -->
@endsection 