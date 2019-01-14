@extends('admin.layout.master')
@section('content')
<!-- Page Header-->
@include('admin.partials.header', ['title' => trans('master.sidebar.product')])
<section class="tables">  
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <a href="{{route('products.index')}}" class="btn btn-success rounded-circle mr-1"><i class="fa fa-arrow-left"></i></a>
                        <h3 class="h4 ml-1">@lang('master.content.action.show', ['attribute' => $products->name])</h3>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                            <h3 class="form-control-label">@lang('master.content.form.image')</h3>
                          <div class="col-sm-8">
                            @foreach($products->images as $image)
                             <a href="storage/product/{{$image->name}}" data-lightbox="product">
                                 <img src="storage/product/{{$image->name}}">
                             </a>
                             @endforeach
                          </div>
                      </div>
                    </div>
                    <div class="card-body">
                        <h3 class="form-control-label">@lang('master.content.table.accessory')</h3>
                        <div class="form-group row">
                        @foreach($products->accessories as $accessory)
                            <label class="col-sm-3 form-control-label mt-2">{{$accessory->parent->name}}</label>
                            <div class="col-sm-9 mt-2">
                                <input class="form-control form-control-sm" value="{{$accessory->name}}" disabled>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        @if(!is_null($products->description))
                        <h3 class="form-control-label">@lang('master.content.form.description')</h3>
                         <p>{!! $products->description !!}</p>
                        @endif
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
