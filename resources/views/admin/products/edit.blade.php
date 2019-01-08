@extends('admin.layout.master')
@section('content')
<!-- Page Header-->
@include('admin.partials.header', ['title' => trans('master.sidebar.product')])
@include('admin.partials.warning')
<!-- Forms Section-->
<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">@lang('master.content.action.edit', ['attribute' => $product->name])</h3>
          </div>
          <div class="card-body">
            <form action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.name')</label>
                <input name="name" type="text" placeholder="Enter product name" class="form-control" value="{{ $product->name }}">
                @include('admin.partials.error', ['err' => 'name'])
              </div>
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.description')</label>
                <textarea name='description' id='demo' class="form-control ckeditor" rows="4" value="">{!!$product->description!!}</textarea>
              </div>
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.price')</label>
                <input name="unit_price" type="text" placeholder="Enter product price" class="form-control" value="{{  $product->unit_price  }}" id='formatCurrency'>
                @include('admin.partials.error', ['err' => 'unit_price'])
              </div>
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.quantity')</label>
                <input name="quantity" type="number" placeholder="Enter product quantity" class="form-control" value="{{  $product->quantity }}">
                @include('admin.partials.error', ['err' => 'quantity'])
              </div>
              <div class="form-group row">
                <label class="form-control-label col-sm-12">@lang('master.content.form.category')</label>
                <div class="col-sm-12">
                  <select class="form-control mb-3" id='parent_category' data-categoryId='{{$product->category_id}}'>
                    @foreach($categories as $category)
                        <option {{ $product->category->parent_id == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12" id="child_category">
                </div>
              </div>
              <div class="form-group">    
                <a href="{{route('products.index')}}" class="btn btn-danger">@lang('master.content.button.cancel')</a>
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
