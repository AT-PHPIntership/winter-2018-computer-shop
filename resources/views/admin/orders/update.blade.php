@extends('admin.layout.master')
@section('content')
<header class="page-header">
   <div class="container-fluid">
       <h2 class="no-margin-bottom">@lang('master.sidebar.order')</h2>
   </div>
</header>
<!-- Breadcrumb-->
<div  class="breadcrumb-holder container-fluid">
   <ul class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('admin.home')}}">@lang('master.sidebar.home')</a></li>
       <li class="breadcrumb-item active">@lang('master.sidebar.order')</li>
   </ul>
</div>

<section class="tables">
   <div class="container-fluid">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <form class="form-horizontal" method="POST" action="{{ route('orders.update', $order->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label class="col-sm-3 form-control-label">@lang('master.content.table.status')</label>
                <div class="col-sm-9">
                  <select name="status" class="form-control mb-3">
                      <option value="{{ \App\Models\Order::PENDING_STATUS }}" {{ $order->status === \App\Models\Order::PENDING_STATUS ? 'select' : '' }}>{{ config('constants.order.status.pending') }}</option>
                      <option value="{{ \App\Models\Order::APPROVE_STATUS }}" {{ $order->status === \App\Models\Order::APPROVE_STATUS ? 'select' : '' }}>{{ config('constants.order.status.approve') }}</option>
                      <option value="{{ \App\Models\Order::CANCEL_STATUS }}" {{ $order->status === \App\Models\Order::CANCEL_STATUS ? 'select' : '' }}>{{ config('constants.order.status.cancel') }}</option>
                  </select>
                </div>
              </div>
            <div class="form-group row">       
              <div class="col-sm-9 offset-sm-3">
                <input type="submit" value="@lang('master.content.button.create')" class="btn btn-primary">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection