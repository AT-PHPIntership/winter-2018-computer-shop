@extends('admin.layout.master')
@section('content')
<header class="page-header">
   <div class="container-fluid">
       <h2 class="no-margin-bottom">@lang('master.sidebar.comment_details')</h2>
   </div>
</header>
<!-- Breadcrumb-->
<div  class="breadcrumb-holder container-fluid">
   <ul class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('admin.home')}}">@lang('master.sidebar.home')</a></li>
       <li class="breadcrumb-item active">@lang('master.sidebar.comment_details')</li>
   </ul>
</div>
<section class="tables">
   <div class="container-fluid">
       <div class="row">
           <div class="col-lg-12">
               <div class="card-header d-flex align-items-center">
                   <a href="{{route('comments.index')}}">
                      <button type="button" class="btn btn-primary fa fa-toggle-left"></button>
                    </a>
               </div> 
               <div class="card">
                   <div class="card-body">
                       <div class="table-responsive">
                           <table class="table table-striped table-hover">
                             <thead>
                               <tr>
                                 <th>@lang('master.content.table.id')</th>
                                 <th>@lang('master.content.table.user_name')</th>
                                 <th>@lang('master.content.table.product_name')</th>
                                 <th>@lang('master.content.table.content')</th>
                                  <th>@lang('master.content.table.action')</th>

                               </tr>
                             </thead>
                             <tbody>
                              @foreach($comment->children as $item)
                              <tr>
                                 <th scope="row">{{ $item->id }}</th>
                                 <th>{{ $item->user->name }}</th>
                                 <th>{{ $item->product->name }}</th>
                                 <th>{{ $item->content }}</th>
                                 <td>
                                   <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                      @csrf
                                      @method('DELETE')
                                      <input type="submit" value="@lang('master.content.action.delete', ['attribute' => 'Role'])" class="btn btn-sm btn-danger">
                                    </form> 
                                   </a>
                                 </td>
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
