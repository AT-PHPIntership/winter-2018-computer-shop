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
                        <h3 class="h4">@lang('master.content.action.edit', ['attribute' => $products->name])</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('products.update', $products->id)}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label class="form-control-label">@lang('master.content.form.name')</label>
                                <input name="name" type="text" placeholder="Enter product name" class="form-control" value="{{ $products->name }}" required>
                                @include('admin.partials.error', ['err' => 'name'])
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">@lang('master.content.form.description')</label>
                                <textarea name='description' id='demo' class="form-control ckeditor" rows="4" value="">{!!$products->description!!}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">@lang('master.content.form.price')</label>
                                <input name="unit_price" type="text" placeholder="Enter product price" class="form-control" value="{{  $products->unit_price  }}" id='formatCurrency' required>
                                @include('admin.partials.error', ['err' => 'unit_price'])
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">@lang('master.content.form.quantity')</label>
                                <input name="quantity" type="number" placeholder="Enter product quantity" class="form-control" value="{{  $products->quantity }}" required>
                                @include('admin.partials.error', ['err' => 'quantity'])
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">@lang('master.content.form.image')</label>
                                <div class="col-sm-12 image-list" id="image-list">
                                    @foreach($products->images as $image)
                                    <div class="image-item" data-id="{{$image->id}}">
                                        <a href="storage/product/{{$image->name}}" data-lightbox="product">
                                            <img src="storage/product/{{$image->name}}" width='125' height='60'>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm fa fa-minus-circle delete-image" value="{{$image->name}}" data-token="{{ csrf_token() }}" data-image-id="{{$image->id}}"></button>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="images[]" type="file" multiple="multiple" class="form-control" value="">
                                @include('admin.partials.error', ['err' => 'images.*'])
                            </div>
                            <div class="form-group row">
                                <label class="form-control-label col-sm-12">@lang('master.content.form.category')</label>
                                <div class="col-sm-12">
                                    <select class="form-control mb-3" id='parent_category' data-category-id='{{$products->category_id}}'>
                                        @foreach($categories as $category)
                                        <option {{ $products->category->parent_id == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
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
                                        <option {{ ($products->accessories->pluck('id')->contains($childrenAccessory->id)) ? 'selected' : ''}} value="{{$childrenAccessory->id}}">{{$childrenAccessory->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                    @include('admin.partials.error', ['err' => 'accessory_id.' . $key])
                                </div>
                            </div>
                            @endforeach
                            <input type="hidden" name="deleteImage" id="deleteImage" value="">
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