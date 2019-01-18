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
                        <h3 class="h4 ml-1">@lang('master.content.action.show', ['attribute' => $product->name])</h3>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        @if(!is_null($product->description))
                        <label class="form-control-label">@lang('master.content.form.description')</label>
                         <p>{!! $product->description !!}</p>
                        @endif
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
