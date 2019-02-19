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
            <h3 class="h4">@lang('master.content.action.edit', ['attribute' => $category->name])</h3>
          </div>
          <div class="card-body">
            <form action="{{route('categories.update', $category->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.name')</label>
                <input name="name" type="text" placeholder="Enter category name" class="form-control" value="{{$category->name}}" required>
                @include('admin.partials.error', ['err' => 'name'])
              </div>
              <div class="form-group row">
                <label class="form-control-label col-sm-12">@lang('master.content.form.parent')</label>
                <div class="col-sm-12">
                  <select name="parent_id" class="form-control mb-3">
                    @if($category->parent_id == null)
                        <option value="" <?php echo 'selected' ?> disabled hidden>@lang('master.content.select.choose')</option>
                    @foreach($categories as $main_category)
                        <option value="{{$main_category->id}}">{{$main_category->name}}</option>
                    @endforeach
                    @else
                      <option value="">@lang('master.content.select.parent')</option>
                    @foreach($categories as $sub_category)
                        <option <?php echo ($sub_category->id == $category->parent_id) ? 'selected' : '' ?> value="{{$sub_category->id}}">{{$sub_category->name}}</option>
                    @endforeach
                    @endif
                  </select>
                  @include('admin.partials.error', ['err' => 'parent_id'])
                </div>
              </div>
              <div class="form-group row">
                <label for="fileInput" class="col-sm-3 form-control-label">@lang('master.content.form.image')</label>
                <div class="col-sm-9">
                @if($category->image == !null)
                <div class="col-sm-4 mb-2">
                    <img src="storage/category/{{$category->image}}" alt="" class="img-thumbnail">
                </div>
                @else
                <div class="col-sm-8">
                    <p class="mt-4 text-danger">{{$category->name}} @lang('master.content.message.img', ['attribute' => trans('master.content.attribute.image')])</p>
                </div>
                @endif
                  <input type="file" id="fileInput" name="image" class="form-control-file">
                  @include('admin.partials.error', ['err' => 'image'])
                </div>
              </div>
              <div class="form-group">    
                <a href="{{route('categories.index')}}" class="btn btn-danger">@lang('master.content.button.cancel')</a>
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
