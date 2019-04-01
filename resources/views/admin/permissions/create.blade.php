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
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.name')<span class="ml-1 text-danger">*<span></label>
                <input name="name" type="text" placeholder="Enter name" class="form-control" value="{{ old('name') }}" required>
                @include('admin.partials.error', ['err' => 'name'])
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
                  <input type="checkbox" value="view" name="permission_action[]" id="permission-view"> <label for="permission-view">@lang('master.content.permissions.view')</label>
                  <br>
                  <input type="checkbox" value="add" name="permission_action[]" id="permission-add"> <label for="permission-add">@lang('master.content.permissions.add')</label>
                  <br>
                  <input type="checkbox" value="edit" name="permission_action[]" id="permission-edit"> <label for="permission-edit">@lang('master.content.permissions.edit')</label>
                  <br>
                  <input type="checkbox" value="delete" name="permission_action[]" id="permission-delete"> <label for="permission-delete">@lang('master.content.permissions.delete')</label>
                  <br>
                </div>
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
