@extends('admin.layout.master')
@section('content')
@include('admin.partials.header', ['title' => trans('master.sidebar.comment')])
@include('admin.partials.message')
@include('admin.partials.warning')
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
                    @include('admin.partials.action_form', ['name' => config('constants.permissions.7'), 'edit' => config('constants.permission-actions.2'), 'delete' => config('constants.permission-actions.3')])
                  </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                <tr class="something">
                    <th scope="row">{{ $comment->id }}</th>
                    <td>{{ $comment->user->name }}</td>
                    <td>{{ $comment->product->name }}</td>
                    <td>{{ $comment->content }}</td>
                    <td>
                      @if ($comment->childrens->count() > 0)
                        @include('admin.partials.detail_button', ['route' => trans('master.content.attribute.comment'), 'id' => $comment->id])
                      @endif
                      @include('admin.partials.delete_button', ['name' => config('constants.permissions.7'), 'action' => config('constants.permission-actions.3'), 'route' => trans('master.content.attribute.comment'), 'id' => $comment->id])
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
