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
                       <a href="{{ URL::previous() }}"><button type="button" class="fa fa-toggle-left btn btn-primary"></button></a>
                   </div>
                   <div class="card-body">
                       <div class="table-responsive">
               <table class="table table-striped table-hover">
                 <thead>
                   <tr>
                     <th>@lang('master.content.table.id')</th>
                     <th>@lang('master.content.form.name')</th>
                     <th>@lang('master.content.table.action')</th>
                   </tr>
                 </thead>
                 <tbody>
                  @foreach($accessory->children as $acces)
                  <tr>
                     <th scope="row">{{ $acces->id }}</th>
                     <td>{{ $acces->name }}</td>
                     <td>
                       <a href="{{ route('accessories.edit', $acces->id) }}" class="btn btn-sm btn-warning">
                       @lang('master.content.action.edit', ['attribute' => __('master.content.attribute.accessory')])
                       </a>
                       <form action="{{ route('accessories.destroy', $acces->id) }}" method="POST" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <input type="submit" value="@lang('master.content.action.delete', ['attribute' => __('master.content.attribute.accessory')])" class="btn btn-sm btn-danger">
                        </form> 
                       </a>
                     </td>
                   </tr>
                   @endforeach
                 </tbody>
               </table>
             </div>
             <div class="row">
                <div class="col-md-12">
                </div>
              </div>
           </div>
         </div>
        </div>
      </div>
    </div>
</section>
@endsection
