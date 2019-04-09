@extends('admin.layout.master')
@section('content')
<!-- Page Header-->
@include('admin.partials.header', ['title' => trans('master.sidebar.product')])
@include('admin.partials.warning')
<!-- Forms Section-->
<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">@lang('master.content.action.add', ['attribute' => trans('master.content.table.product')])</h3>
          </div>
          <div class="card-body">
            <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" id="create-product">
            @csrf
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.name')<span class="ml-1 text-danger">*<span></label>
                <input name="name" type="text" placeholder="Enter product name" class="form-control" value="{{ old('name') }}" required>
                @include('admin.partials.error', ['err' => 'name'])
              </div>
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.description')</label>
                <textarea name='description' id='demo' class="form-control ckeditor" rows="4" value="">{{old('description')}}</textarea>
              </div>
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.price')<span class="ml-1 text-danger">*<span></label>
                <input name="unit_price" type="text" placeholder="Enter product price" class="form-control" value="{{ old('unit_price') }}" id='formatCurrency' required>
                @include('admin.partials.error', ['err' => 'unit_price'])
              </div>
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.quantity')<span class="ml-1 text-danger">*<span></label>
                <input name="quantity" type="number" placeholder="Enter product quantity" class="form-control" value="{{ old('quantity') }}" required>
                @include('admin.partials.error', ['err' => 'quantity'])
              </div>
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.image')</label>
                <input name="images[]" type="file" multiple="multiple" class="form-control" value="">
                @include('admin.partials.error', ['err' => 'images.*'])
              </div>

              <div class="form-group row">
                <label class="form-control-label col-sm-12">@lang('master.content.form.category')<span class="ml-1 text-danger">*<span></label>
                <div class="col-sm-12 replace-category-by-input">
                  <select name='parent_category' class="form-control mb-3" id='parent_category' required>
                    <option value="" selected disabled hidden>@lang('master.content.select.choose')</option>
                    @foreach($categories as $category)
                        <option class="parent_category" {{ (old('parent_category') == strval($category->id)) ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
                  @include('admin.partials.error', ['err' => 'category_id'])
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12" id="child_category">
                </div>
              </div>
              @foreach($parentAccessories as $key => $parentAccessory)
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">{{$parentAccessory->name}}</label>
                <div class="col-sm-9 replace-by-input" data-id="{{$parentAccessory->id}}">
                  <select name="accessory_id[]" class="form-control mb-3">
                    <option value="" selected disabled hidden>@lang('master.content.select.choose')</option>
                    @foreach($accessories as $childrenAccessory)
                      @if($childrenAccessory->parent_id ==  $parentAccessory->id)
                        <option {{ (old('accessory_id.' . $key) == strval($childrenAccessory->id)) ? 'selected' : ''}} value="{{$childrenAccessory->id}}">{{$childrenAccessory->name}}</option>
                      @endif
                    @endforeach
                  </select>
                    @include('admin.partials.error', ['err' => 'accessory_id.' . $key])
                </div>
              </div>
              @endforeach
              <div class="form-group">    
                <a href="{{route('products.index')}}" class="btn btn-danger">@lang('master.content.button.cancel')</a>
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
