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
            <h3 class="h4">@lang('master.content.action.add', ['attribute' => trans('master.content.attribute.User')])</h3>
          </div>
          <div class="card-body">
            <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.table.email')<span class="ml-1 text-danger">*<span></label>
                <input name="email" type="email" placeholder="Email Address" class="form-control" value="{{ old('email') }}" required>
                @include('admin.partials.error', ['err' => 'email'])
              </div>
              <div class="form-group">       
                <label class="form-control-label">@lang('master.content.form.password')<span class="ml-1 text-danger">*<span></label>
                <input name="password" type="password" placeholder="Password" class="form-control" required>
                @include('admin.partials.error', ['err' => 'password'])
              </div>
              <div class="form-group">       
                <label class="form-control-label">@lang('master.content.form.confirm_pw')<span class="ml-1 text-danger">*<span></label>
                <input name="password_confirmation" type="password" placeholder="Confirm Password" class="form-control" required>
              </div>
              <div class="form-group">       
                <label class="form-control-label">@lang('master.content.form.name')<span class="ml-1 text-danger">*<span></label>
                <input name="name" type="text" placeholder="Name" class="form-control" value="{{ old('name') }}" required>
                @include('admin.partials.error', ['err' => 'name'])
              </div>
              <div class="form-group">       
                <label class="form-control-label">@lang('master.content.form.address')<span class="ml-1 text-danger">*<span></label>
                <input name="address" type="text" placeholder="Address" class="form-control" value="{{ old('address') }}" required>
                @include('admin.partials.error', ['err' => 'address'])
              </div>
              <div class="form-group">       
                <label class="form-control-label">@lang('master.content.form.phone')<span class="ml-1 text-danger">*<span></label>
                <input name="phone" type="text" placeholder="Phone" class="form-control" value="{{ old('phone') }}"` required>
                @include('admin.partials.error', ['err' => 'phone'])`
              </div>
              <div class="form-group row">
                <label class="form-control-label col-sm-12">@lang('master.content.table.role')</label>
                <div class="col-sm-12">
                  <select name="role_id" class="form-control mb-3">
                    @foreach($roles as $role)
                    <option <?php echo ($role->name == 'Normal') ? 'selected' : '' ?> value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                  </select>
                  @include('admin.partials.error', ['err' => 'role_id'])
                </div>
              </div>
              <div class="form-group row">
                <label for="fileInput" class="col-sm-3 form-control-label">@lang('master.content.form.avatar')</label>
                <div class="col-sm-9">
                  <input type="file" id="fileInput" name="avatar" class="form-control-file">
                  @include('admin.partials.error', ['err' => 'avatar'])
                </div>
              </div>
              <div class="form-group">    
                <a href="{{route('users.index')}}" class="btn btn-danger">@lang('master.content.button.cancel')</a>
                <input type="submit" value="@lang('master.content.button.create')" class="btn btn-primary">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
