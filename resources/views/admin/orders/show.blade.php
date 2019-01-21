@extends('admin.layout.master')
@section('content')
<header class="page-header">
   <div class="container-fluid">
       <h2 class="no-margin-bottom">@lang('master.sidebar.order_details')</h2>
   </div>
</header>
<!-- Breadcrumb-->
<div  class="breadcrumb-holder container-fluid">
   <ul class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('admin.home')}}">@lang('master.sidebar.home')</a></li>
       <li class="breadcrumb-item active">@lang('master.sidebar.order_details')</li>
   </ul>
</div>
<section class="tables">
   <div class="container-fluid">
       <div class="row">
           <div class="col-lg-12">
               <div class="card-header d-flex align-items-center">
                   <a href="{{route('orders.index')}}">
                      <button type="button" class="btn btn-primary">@lang('master.content.action.back')</button>
                    </a>
               </div> 
               <div class="card">
                   <div class="card-body">
                       <div class="table-responsive">
                           <table class="table table-striped table-hover">
                             <thead>
                               <tr>
                                 <th>@lang('master.content.table.id')</th>
                                 <th>@lang('master.content.table.product_name')</th>
                                 <th>@lang('master.content.table.quantity')</th>
                                 <th>@lang('master.content.table.price')</th>
                               </tr>
                             </thead>
                             <tbody>
                              @foreach($order->orderDetails as $orderDetail)
                              <tr>
                                 <th scope="row">{{ $orderDetail->id }}</th>
                                 <th>{{ $orderDetail->product->name }}</th>
                                 <th>{{ $orderDetail->quantity }}</th>
                                 <th>{{ $orderDetail->price }}</th>
                               </tr>
                               @endforeach
                             </tbody>
                           </table>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</section>
@endsection
