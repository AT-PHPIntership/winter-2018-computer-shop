@extends('admin.layout.master')
@section('content')
<header class="page-header">
   <div class="container-fluid">
       <h2 class="no-margin-bottom">@lang('master.sidebar.code')</h2>
   </div>
</header>
<!-- Breadcrumb-->
<div  class="breadcrumb-holder container-fluid">
   <ul class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('admin.home')}}">@lang('master.sidebar.home')</a></li>
       <li class="breadcrumb-item active">@lang('master.sidebar.code')</li>
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
                       <a href="{{route('codes.create')}}">
                          <button type="button" class="btn btn-primary">@lang('master.content.action.add', ['attribute' => __('master.content.attribute.code')])</button>
                        </a>
                   </div>
                   <div class="card-body">
                       <div class="table-responsive">
               <table class="table table-striped table-hover">
                 <thead>
                   <tr>
                     <th>@lang('master.content.table.id')</th>
                     <th>@lang('master.content.form.name')</th>
                     <th>@lang('master.content.table.amount')</th>
                     <th>@lang('master.content.table.start_at')</th>
                     <th>@lang('master.content.table.end_at')</th>
                     <th>@lang('master.content.table.order_month')</th>
                     <th>@lang('master.content.table.all_user')</th>
                     <th>@lang('master.content.table.action')</th>
                   </tr>
                 </thead>
                 <tbody>
                  @foreach($codes as $code)
                  <tr>
                     <th scope="row">{{ $code->id }}</th>
                     <td>{{ $code->name }}</td>
                     <td>{{ $code->amount }}</td>
                     <td>{{ $code->start_at }}</td>
                     <td>{{ $code->end_at }}</td>
                     <td>{{ $code->order_month }}</td>
                     <td>{{ $code->all_user }}</td>
                     <td>
                       <a href="{{ route('codes.edit', $code->id) }}" class="btn btn-sm btn-warning">
                       @lang('master.content.action.edit', ['attribute' => __('master.content.attribute.code')])
                       </a>
                       <form action="{{ route('codes.destroy', $code->id) }}" method="POST" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <input type="submit" value="@lang('master.content.action.delete', ['attribute' => __('master.content.attribute.code')])" class="btn btn-sm btn-danger">
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
                  {{ $codes->links() }}
                </div>
              </div>
           </div>
         </div>
        </div>
      </div>
    </div>
</section>
@endsection
