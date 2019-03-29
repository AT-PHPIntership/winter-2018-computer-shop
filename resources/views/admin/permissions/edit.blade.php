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
            <h3 class="h4">@lang('master.content.action.edit', ['attribute' => $permission->display_name])</h3>
          </div>
          <div class="card-body">
            <form action="{{route('permissions.update', $permission->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.name')</label>
                <input name="name" type="text" placeholder="Enter name" class="form-control" value="{{$permission->name}}" required>
                @include('admin.partials.error', ['err' => 'name'])
              </div>
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.display')</label>
                <input name="display_name" type="text" placeholder="Enter  dislay name" class="form-control" value="{{ $permission->display_name }}" required>
                @include('admin.partials.error', ['err' => 'display_name'])
              </div>
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.description')</label>
                <textarea name='description' id='demo' class="form-control ckeditor" rows="4" value="">{{$permission->description}}</textarea>
                @include('admin.partials.error', ['err' => 'description'])
              </div>
              <div class="form-group">    
                <a href="{{route('permissions.index')}}" class="btn btn-danger">@lang('master.content.button.cancel')</a>
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
