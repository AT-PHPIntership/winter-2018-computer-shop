@extends('admin.layout.master')
@section('content')
<!-- Page Header-->
@include('admin.partials.header', ['title' => trans('master.sidebar.user')])
@include('admin.partials.warning')
<!-- Forms Section-->
<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">@lang('master.content.action.edit', ['attribute' => $user->name])</h3>
          </div>
          <div class="card-body">
            <form action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.table.email')</label>
                <input name="email" type="email" placeholder="Email Address" class="form-control" value="{{$user->email}}">
                @include('admin.partials.error', ['err' => 'email'])
              </div>
              <div class="form-group">       
                <label class="form-control-label">@lang('master.content.form.name')</label>
                <input name="name" type="text" placeholder="Name" class="form-control" value="{{$user->name}}">
                @include('admin.partials.error', ['err' => 'name'])
              </div>
              <div class="form-group">       
                <label class="form-control-label">@lang('master.content.form.address')</label>
                <input name="address" type="text" placeholder="Address" class="form-control" value="{{$user->profile->address}}">
                @include('admin.partials.error', ['err' => 'address'])
              </div>
              <div class="form-group">       
                <label class="form-control-label">@lang('master.content.form.phone')</label>
                <input name="phone" type="text" placeholder="Phone" class="form-control" value="{{$user->profile->phone}}">
                @include('admin.partials.error', ['err' => 'phone'])
              </div>
              <div class="form-group row">
                <label class="form-control-label col-sm-12">@lang('master.content.table.role')</label>
                <div class="col-sm-12">
                  <select name="role_id" class="form-control mb-3">
                    @foreach($roles as $role)
                    <option <?php echo ($role->id == $user->role_id) ? 'selected' : '' ?> value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="fileInput" class="col-sm-3 form-control-label">@lang('master.content.form.avatar')</label>
                <div class="col-sm-9">
                @if($user->profile->avatar == !null)
                <div class="col-sm-2">
                    <img src="storage/avatar/{{$user->profile->avatar}}" alt="" class="img-thumbnail">
                </div>
                @else
                <div class="col-sm-8">
                    <p class="mt-4 text-danger">{{$user->name}} @lang('master.content.message.img')</p>
                </div>
                @endif
                  <input type="file" id="fileInput" name="avatar" class="form-control-file mt-1">
                  @include('admin.partials.error', ['err' => 'avatar'])
                </div>
              </div>
              <div class="form-group">    
                <a href="{{route('users.index')}}" class="btn btn-danger">@lang('master.content.button.cancel')</a>
                <input type="submit" value="@lang('master.content.button.update')" class="btn btn-primary">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
