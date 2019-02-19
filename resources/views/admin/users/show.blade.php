@extends('admin.layout.master')
@section('content')
<!-- Page Header-->
@include('admin.partials.header', ['title' => trans('master.sidebar.user')])
<!-- Forms Section-->
<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <a href="{{route('users.index')}}" class="btn btn-success rounded-circle"><i class="fa fa-arrow-left"></i></a>
            <h3 class="h4 ml-1">@lang('master.content.action.show', ['attribute' => $user->name])</h3>
          </div>
          <div class="card-body">
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.table.email')</label>
                <input name="email" type="email" placeholder="Email Address" class="form-control" value="{{$user->email}}" disabled>
              </div>
              <div class="form-group">       
                <label class="form-control-label">@lang('master.content.form.address')</label>
                <input name="address" type="text" placeholder="Address" class="form-control" value="{{$user->profile->address}}" disabled>
              </div>
              <div class="form-group">       
                <label class="form-control-label">@lang('master.content.form.phone')</label>
                <input name="phone" type="text" placeholder="Phone" class="form-control" value="{{$user->profile->phone}}" disabled>
              </div>
              <div class="form-group row">
                <label for="fileInput" class="col-sm-3 form-control-label">@lang('master.content.form.avatar')</label>
                @if($user->profile->avatar == !null)
                <div class="col-sm-2">
                    <img src='{{ (is_numeric($user->profile->avatar[0])) ? 'storage/avatar/' .$user->profile->avatar : $user->profile->avatar }}' alt="" class="img-thumbnail">
                </div>
                @else
                <div class="col-sm-8">
                    <p class="mt-4 text-danger">{{$user->name}} @lang('master.content.message.img', ['attribute' => trans('master.content.attribute.avatar')])</p>
                </div>
                @endif
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
