@extends('admin.layout.master')
@section('content')
<!-- Page Header-->
@include('admin.partials.header', ['title' => trans('master.sidebar.permission')])
<!-- Forms Section-->
<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">@lang('master.content.action.add', ['attribute' => trans('master.content.attribute.Permission')])</h3>
          </div>
          <div class="card-body">
            <form action="{{route('permissions.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label class="form-control-label col-sm-12">@lang('master.content.form.name')</label>
                <div class="col-sm-12">
                  <select name="name" class="form-control mb-3">
                    <option value="" selected disabled hidden>@lang('master.content.select.choose')</option>
                    @foreach(config('constants.permissions') as $key => $permission)
                        <option {{(old('name') == $permission) ? 'selected' : ''}} value="{{$permission}}">{{$permission}}</option>
                    @endforeach
                  </select>
                  @include('admin.partials.error', ['err' => 'name'])
                </div>
              </div>
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.display')<span class="ml-1 text-danger">*<span></label>
                <input name="display_name" type="text" placeholder="Enter  dislay name" class="form-control" value="{{ old('display_name') }}" required>
                @include('admin.partials.error', ['err' => 'display_name'])
              </div>
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.description')</label>
                <textarea name='description' id='demo' class="form-control ckeditor" rows="4" value="">{{old('description')}}</textarea>
                @include('admin.partials.error', ['err' => 'description'])
              </div>
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.action.product.details')</label>
                <div class="col-lg-6">
                  @foreach (config('constants.permission-actions') as $key => $action)
                  <div>
                    <input type="checkbox" value="{{$action}}" name="permission_action[]" {{(old('permission_action.' .$key) == $action) ? 'checked' : ''}}> 
                    <label for="permission-view">@lang('master.content.permissions.' . $key)</label>
                  </div>
                  @endforeach
                </div>
                @include('admin.partials.error', ['err' => 'permission_action.*'])
                @include('admin.partials.error', ['err' => 'permission_action'])
              </div>
              <div class="form-group">    
                <a href="{{route('permissions.index')}}" class="btn btn-danger">@lang('master.content.button.cancel')</a>
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
