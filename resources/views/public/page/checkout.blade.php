@extends('public.layout.master')
@section('content')


<!-- Checkout Page Start -->
<div class="page-section section mt-90 mb-30">
  
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if(session('message'))
                  <div class="col-12 alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">
                          <i class="ace-icon fa fa-times"></i>
                      </button>
                          {{session('message')}}
                  </div>
                @endif
                <!-- Checkout Form s-->
                <form id="checkout-form" action="{{ route('public.order') }}" method="POST" class="checkout-form">
                  @csrf
                   <div class="row row-40">
                       
                       <div class="col-lg-7 mb-20">
                          
                           <!-- Billing Address -->
                           <div id="billing-form" class="mb-40">
                               <h4 class="checkout-title">Billing Address</h4>

                               <div class="row">

                                   <div class="col-md-6 col-12 mb-20">
                                       <label>Full Name</label>
                                       <input readonly type="text" placeholder="First Name" value="{{ Auth::user()->name }}">
                                       <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                                   </div>

                                   <div class="col-md-6 col-12 mb-20">
                                       <label>Email Address</label>
                                       <input readonly type="email" placeholder="Email Address" value="{{ Auth::user()->email }}">
                                   </div>

                                      <div class="col-12 mb-20">
                                         <label>Phone no*</label>
                                         <input type="text" placeholder="Phone number" name="phone" value="{{ old('phone', Auth::user()->profile->phone)   }}">
                                     </div> 
                                     @if ($errors->has('phone'))
                                        <span class="help-block col-6">
                                            <strong class="col-6 text-danger">{{ $errors->first('phone') }}</strong>
                                        </span>
                                      @endif 

                                     <div class="col-12 ">
                                         <label>Address*</label>
                                         <input type="text" placeholder="Address" name="address" value="{{ old('address', Auth::user()->profile->address) }}">
                                     </div>
                                     @if ($errors->has('address'))
                                        <span class="help-block col-sm-6">
                                            <strong class="col-6 text-danger">{{ $errors->first('address') }}</strong>
                                        </span>
                                      @endif

                                  <div class="col-md-12 col-12">
                                       <label>Note*</label>
                                       <input type="text" placeholder="Note" name="note" value="{{ old('note') }}">
                                   </div>

                                   @if ($errors->has('note'))
                                      <span class="help-block col-sm-12">
                                          <strong class="col-xs-6 col-sm-6 text-danger">{{ $errors->first('note') }}</strong>
                                      </span>
                                    @endif

                               </div>

                           </div>
                           
                           
                           
                       </div>
                       
                       <div class="col-lg-5">
                           <div class="row">
                               
                               <!-- Cart Total -->
                               <div class="col-12 mb-60">
                               
                                   <h4 class="checkout-title">Cart Total</h4>
                           
                                   <div class="checkout-cart-total">

                                       <h4>Product <span>Total</span></h4>
                                       
                                       <ul id="table-checkout">

                                       </ul>
                                       
                                       <p>Sub Total <span>$1250.00</span></p>
                                       <p>Shipping Fee <span>$00.00</span></p>
                                       
                                       <h4>Grand Total <span>$1250.00</span></h4>
                                       
                                   </div>
                                   
                                   <button onclick="deleteLocal()" id="delete-local" class="place-order">Place order</button>
                                   
                               </div>
                               
                           </div>
                       </div>
                       
                   </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

<!-- Checkout Page End --> 
@endsection