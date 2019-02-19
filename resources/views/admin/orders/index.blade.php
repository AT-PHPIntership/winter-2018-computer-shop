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
@if(session('message'))
    <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">
        <i class="ace-icon fa fa-times"></i>
    </button>
        {{session('message')}}
    </div>
@endif
<section class="tables">
   <div class="container-fluid">
       <div class="row">
           <div class="col-lg-12">
               <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                           <table class="table table-striped table-hover">
                             <thead>
                               <tr>
                                 <th>@lang('master.content.table.id')</th>
                                 <th>@lang('master.content.table.user')</th>
                                 <th>@lang('master.content.table.address')</th>
                                 <th>@lang('master.content.table.phone')</th>
                                 <th>@lang('master.content.table.note')</th>
                                 <th>@lang('master.content.table.date_order')</th>
                                 <th>@lang('master.content.table.status')</th>
                                 <th>@lang('master.content.table.action')</th>
                               </tr>
                             </thead>
                             <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <th scope="row">{{ $order->id }}</th>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->note }}</td>
                                    <td>{{ $order->date_order }}</td>
                                    <td>{{ $order->getCurrentStatusAttribute() }}</td>
                                    <td>
                                      <a href="{{ route('orders.show', $order->id) }}">
                                        <button type="button" class="btn-sm btn-info">@lang('master.content.table.details')</button>
                                      </a>
                                      <a href="{{ route('orders.edit', $order->id) }}">
                                        <button type="button" class="btn-sm btn-success">@lang('master.content.action.edit', ['attribute' => 'Order'])</button>
                                      </a>
                                      <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirmedDeleteOrder('delete')">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="@lang('master.content.action.delete', ['attribute' => 'Order'])" class="btn btn-sm btn-danger">
                                      </form> 
                                     </td>
                                   </tr>
                                @endforeach
                             </tbody>
                           </table>
                        </div>
                      <div class="row">
                        <div class="col-md-12">
                          {{ $orders->links()}}
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
