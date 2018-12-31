@extends('admin.layout.master')
@section('content')
<!-- Page Header-->
@include('admin.partials.header', ['title' => trans('master.sidebar.category')])
<!-- Forms Section-->
<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">@lang('master.content.action.add', ['attribute' => 'Category'])</h3>
          </div>
          <div class="card-body">
            <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.name')<span class="ml-1 text-danger">*<span></label>
                <input name="name" type="text" placeholder="Enter category name" class="form-control" value="{{ old('category') }}">
                @include('admin.partials.error', ['err' => 'name'])
              </div>
              <div class="form-group row">
                <label class="form-control-label col-sm-12">@lang('master.content.form.parent')</label>
                <div class="col-sm-12">
                  <select name="parent_id" class="form-control mb-3">
                    <option value="" selected disabled hidden>Choose here</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">    
                <a href="{{route('categories.index')}}" class="btn btn-danger">@lang('master.content.button.cancel')</a>
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
