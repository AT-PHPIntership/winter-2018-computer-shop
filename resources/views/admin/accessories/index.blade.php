@extends('admin.layout.master')
@section('content')
<header class="page-header">
   <div class="container-fluid">
       <h2 class="no-margin-bottom">@lang('master.sidebar.accessory')</h2>
   </div>
</header>
<!-- Breadcrumb-->
<div  class="breadcrumb-holder container-fluid">
   <ul class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('admin.home')}}">@lang('master.sidebar.home')</a></li>
       <li class="breadcrumb-item active">@lang('master.sidebar.accessory')</li>
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
                   <div class="card-header d-flex align-items-center">
                       <a href="{{route('accessories.create')}}">
                          <button type="button" class="btn btn-primary">@lang('master.content.action.add', ['attribute' => __('master.content.attribute.accessory')])</button>
                        </a>
                   </div>
                   <div class="card-body">
                       <div class="table-responsive">
               <table class="table table-striped table-hover text-center">
                 <thead>
                    <tr>
                      <th>@lang('master.content.table.id')</th>
                      <th>@lang('master.content.form.name')</th>
                      <th>@lang('master.content.table.action')</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($accessories as $accesory)
                  <tr>
                      <th scope="row">{{ $accesory->id }}</th>
                      <td>{{ $accesory->name }}</td>
                      <td>
                        @if(sizeof($accesory->children) > 0)
                          <a href="{{ route('accessories.show', $accesory->id) }}" class="btn btn-sm btn-info">
                          @lang('master.content.action.product.details')
                          </a>
                        @endif
                          <a href="{{ route('accessories.edit', $accesory->id) }}" class="btn btn-sm btn-warning">
                          @lang('master.content.action.product.edit')
                          </a>
                        @if(sizeof($accesory->children) == 0)
                          <form action="{{ route('accessories.destroy', $accesory->id) }}" method="POST" class="d-inline" onsubmit="return confirmedDelete('accessory')">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="@lang('master.content.action.product.delete')" class="btn btn-sm btn-danger">
                          </form> 
                        @endif
                     </td>
                   </tr>
                   @endforeach
                 </tbody>
               </table>
             </div>
             <div class="row">
                <div class="col-md-12">
                {{$accessories->links()}}
                </div>
              </div>
           </div>
         </div>
        </div>
      </div>
    </div>
</section>
@endsection
