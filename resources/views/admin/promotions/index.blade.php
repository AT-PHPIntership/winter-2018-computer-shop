@extends('admin.layout.master')
@section('content')
<header class="page-header">
   <div class="container-fluid">
       <h2 class="no-margin-bottom">@lang('master.sidebar.promotion')</h2>
   </div>
</header>
<!-- Breadcrumb-->
<div  class="breadcrumb-holder container-fluid">
   <ul class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('admin.home')}}">@lang('master.sidebar.home')</a></li>
       <li class="breadcrumb-item active">@lang('master.sidebar.promotion')</li>
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
                       <a href="{{route('promotions.create')}}">
                          <button type="button" class="btn btn-primary">@lang('master.content.action.add', ['attribute' => 'Promotion'])</button>
                        </a>
                   </div>
                   <div class="card-body">
                       <div class="table-responsive">
               <table class="table table-striped table-hover text-center">
                 <thead>
                   <tr>
                     <th>@lang('master.content.table.id')</th>
                     <th>@lang('master.content.form.name')</th>
                     <th>@lang('master.content.table.percent')</th>
                     <th>@lang('master.content.table.start_at')</th>
                     <th>@lang('master.content.table.end_at')</th>
                     <th>@lang('master.content.table.total_sold')</th>
                     <th>@lang('master.content.table.action')</th>
                   </tr>
                 </thead>
                 <tbody>

                  @foreach($promotions as $promotion)
                  <tr>
                     <th scope="row">{{ $promotion->id }}</th>
                     <td>{{ $promotion->name }}</td>
                     <td>{{ $promotion->percent }}</td>
                     <td>{{ $promotion->start_at }}</td>
                     <td>{{ $promotion->end_at }}</td>
                     <td>{{ $promotion->total_sold }}</td>
                     <td>
                       <a href="{{ route('promotions.edit', $promotion->id) }}" class="btn btn-sm btn-warning">
                       @lang('master.content.action.edit', ['attribute' => 'Promotion'])
                       </a>
                       <form action="{{ route('promotions.destroy', $promotion->id) }}" method="POST" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <input type="submit" value="@lang('master.content.action.delete', ['attribute' => 'Promotion'])" class="btn btn-sm btn-danger">
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
                {{ $promotions->links() }}
                </div>
              </div>
           </div>
         </div>
        </div>
      </div>
    </div>
</section>
@endsection
