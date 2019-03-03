@extends('public.layout.master')
@section('content')
<!-- Cart Page Start -->
<div class="page-section section pt-90 pb-50">
    <div class="container">
        <div class="row">
            @if(session('message'))
            <div class="col-12 alert alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
                {{session('message')}}
            </div>
            @endif
            <div class="col-12">
                <form action="#">
                    <!-- Cart Table -->
                    <div class="cart-table table-responsive mb-40">
                        <table class="table" id="table-products">
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">Image</th>
                                    <th class="pro-title">Product</th>
                                    <th class="pro-price">Price</th>
                                    <th class="pro-quantity">Quantity</th>
                                    <th class="pro-subtotal">Total</th>
                                    <th class="pro-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                    </div>

                </form>

                <div class="row">

                    <div class="col-lg-6 col-12 mb-15">

                        <!-- Discount Coupon -->
                        <div class="discount-coupon">
                            <h4>Discount Coupon Code</h4>
                            <form action="{{ route('public.code') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-25">
                                        <input type="text" name="nameCode" value="{{ old('name') }}" placeholder="Coupon Code">
                                        @if(Auth::check())
                                        <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                                        @endIf
                                    </div>
                                    <div class="col-md-6 col-12 mb-25">
                                        @if(Auth::check())
                                        <input type="submit" value="Apply Code">
                                        @else
                                        <p class="text-success">You must login that apply code</p>
                                        @endIf
                                    </div>
                                </div>
                            </form>
                            @if(session('message'))
                            <div class="col-4 alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="ace-icon fa fa-times"></i>
                                </button>
                                {{session('message')}}
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Cart Summary -->
                    <div class="col-lg-6 col-12 mb-40 d-flex">
                        <div class="cart-summary">
                            <div class="cart-summary-wrap">
                                <h4>Cart Summary</h4>
                                <p>Total <span id="total-price">0 d</span></p>
                            </div>
                            <div class="cart-summary-button">
                                <a href="{{ route('public.checkout', ['amount' => 0, 'codeId' => 0]) }}"><button class="checkout-btn">Checkout</button></a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- Cart Page End -->
@endsection 