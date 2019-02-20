@extends('admin.layout.master')
@section('content')
<header class="page-header">
   <div class="container-fluid">
       <h2 class="no-margin-bottom">@lang('master.sidebar.comment')</h2>
   </div>
</header>
<!-- Breadcrumb-->
<div  class="breadcrumb-holder container-fluid">
   <ul class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('admin.home')}}">@lang('master.sidebar.home')</a></li>
       <li class="breadcrumb-item active">@lang('master.sidebar.comment')</li>
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
               <table class="table table-striped table-hover text-center  ">
                 <thead>
                   <tr class="something">
                     <th>@lang('master.content.table.id')</th>
                     <th>@lang('master.content.table.user_name')</th>
                     <th>@lang('master.content.table.product_name')</th>
                     <th>@lang('master.content.table.content')</th>
                     <th>@lang('master.content.table.action')</th>
                   </tr>
                 </thead>
                 <tbody>
                  @foreach($comments as $comment)
                  <tr class="something">
                     <th scope="row"  >{{ $comment->id }}</th>
                     <td>{{ $comment->user->name }}</td>
                     <td>{{ $comment->product->name }}</td>
                     <td>{{ $comment->content }}</td>
                     <td>
                       @if ($comment->childrens->count() > 0)
                       <a href="{{ route('comments.show', $comment->id) }}" class="btn btn-sm btn-warning">
                       @lang('master.content.action.product.details')
                       </a>
                       @endif
                       <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline" onsubmit="return confirmedDelete('comment')">
                          @csrf
                          @method('DELETE')
                          <input type="submit" value="@lang('master.content.action.product.delete')" class="btn btn-sm btn-danger">
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
                {{$comments->links()}}
                </div>
              </div>
           </div>
         </div>
        </div>
      </div>
    </div>
</section>
@endsection
