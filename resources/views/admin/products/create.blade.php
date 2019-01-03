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
            <h3 class="h4">@lang('master.content.action.add', ['attribute' => trans('master.content.table.product')])</h3>
          </div>
          <div class="card-body">
            <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.name')<span class="ml-1 text-danger">*<span></label>
                <input name="name" type="text" placeholder="Enter product name" class="form-control" value="{{ old('name') }}">
                @include('admin.partials.error', ['err' => 'name'])
              </div>
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.description')</label>
                <input name="description" type="text" placeholder="Enter product description" class="form-control" value="{{ old('description') }}">
                @include('admin.partials.error', ['err' => 'description'])
              </div>
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.price')<span class="ml-1 text-danger">*<span></label>
                <input name="unit_price" type="text" placeholder="Enter product price" class="form-control" value="{{ old('unit_price') }}" id='formatCurrency'>
                @include('admin.partials.error', ['err' => 'unit_price'])
              </div>
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.quantity')<span class="ml-1 text-danger">*<span></label>
                <input name="quantity" type="number" placeholder="Enter product quantity" class="form-control" value="{{ old('quantity') }}">
                @include('admin.partials.error', ['err' => 'quantity'])
              </div>
              <div class="form-group row">
                <label class="form-control-label col-sm-12">@lang('master.content.form.category')</label>
                <div class="col-sm-12">
                  <select name='parent_category' class="form-control mb-3" id='parent_category'>
                    <option value="" selected disabled hidden>Choose here</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
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
