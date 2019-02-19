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
                  <a href="{{route('orders.index')}}" class="btn btn-success rounded-circle mr-1"><i class="fa fa-arrow-left"></i></a>
               </div> 
               <div class="card">
                   <div class="card-body">
                       <div class="table-responsive">
                           <table class="table table-striped table-hover text-center ">
                             <thead>
                               <tr>
                                 <th>@lang('master.content.table.id')</th>
                                 <th>@lang('master.content.form.name')</th>
                                 <th>@lang('master.content.form.quantity')</th>
                                 <th>@lang('master.content.form.price')</th>
                               </tr>
                             </thead>
                             <tbody>
                              @foreach($order->orderDetails as $orderDetail)
                              <tr>
                                 <th>{{ $orderDetail->id }}</th>
                                 <th>{{ $orderDetail->product->name }}</th>
                                 <th>{{ $orderDetail->quantity }}</th>
                                 <th>{!!number_format($orderDetail->price,0,",",".") . ' vnđ'!!}</th>
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
