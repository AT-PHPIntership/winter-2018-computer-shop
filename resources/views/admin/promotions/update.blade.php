@extends('admin.layout.master')
@section('content')
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">@lang('master.sidebar.promotion')</h2>
    </div>
</header>
<!-- Breadcrumb-->
<div class="breadcrumb-holder container-fluid">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">@lang('master.sidebar.home')</a></li>
        <li class="breadcrumb-item active">@lang('master.sidebar.promotion')</li>
    </ul>
</div>

<section class="tables">
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('promotions.update', $promotion->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">@lang('master.content.form.name')</label>
                            <div class="col-sm-9">
                                <input id="inputHorizontalWarning" type="text" name="name" placeholder="Name" class="form-control" value="{{ old('name') ? old('name') : $promotion->name }}" required>
                                @if ($errors->has('name'))
                                <span class="help-block col-sm-12">
                                    <strong class="col-xs-12 col-sm-12 text-danger">{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">@lang('master.content.table.percent')</label>
                            <div class="col-sm-9">
                                <input id="inputHorizontalWarning" type="number" name="percent" placeholder="Percent" class="form-control" value="{{ old('percent') ? old('percent') : $promotion->percent }}" required>
                                @if ($errors->has('percent'))
                                <span class="help-block col-sm-12">
                                    <strong class="col-xs-12 col-sm-12 text-danger">{{ $errors->first('percent') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">@lang('master.content.table.start_at')</label>
                            <div class="col-sm-9">
                                <input type="date" name="start_at" value="{{ old('start_at') ? old('start_at') : $promotion->start_at }}" required>
                                @if ($errors->has('start_at'))
                                <span class="help-block col-sm-12">
                                    <strong class="col-xs-12 col-sm-12 text-danger">{{ $errors->first('start_at') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">@lang('master.content.table.end_at')</label>
                            <div class="col-sm-9">
                                <input type="date" name="end_at" value="{{ old('end_at') ? old('end_at') : $promotion->end_at }}" required>
                                @if ($errors->has('end_at'))
                                <span class="help-block col-sm-12">
                                    <strong class="col-xs-12 col-sm-12 text-danger">{{ $errors->first('end_at') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Category</label>
                            <div class="col-sm-9">
                                <select name="category_id" class="form-control mb-3 category_id">
                                    <option value="">{{ __('master.content.select.choose') }}</option>
                                    @foreach ($categoriesChildren as $category)
                                        <option value="{{ $category->id }}" {{ ((old('category_id') == $category->id) || ($promotion->category_id == $category->id)) ? "selected" : "" }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                <span class="help-block col-sm-12">
                                    <strong class="col-xs-12 col-sm-12 text-danger">{{ $errors->first('category_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">@lang('master.content.table.total_sold')</label>
                            <div class="col-sm-9">
                                <input id="inputHorizontalWarning" type="number" name="total_sold" placeholder="Total Sold" class="form-control total_sold" value="{{ old('total_sold') ? old('total_sold') : $promotion->total_sold }}" required>
                                @if ($errors->has('total_sold'))
                                <span class="help-block col-sm-12">
                                    <strong class="col-xs-12 col-sm-12 text-danger">{{ $errors->first('total_sold') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Price Product (<)</label>
                            <div class="col-sm-9">
                                <input id="inputHorizontalWarning" type="number" name="price_product" placeholder="" class="form-control price_product" value="{{ old('price_product') ? old('price_product') : $promotion->price_product }}" >
                                @if ($errors->has('price_product'))
                                <span class="help-block col-sm-12">
                                    <strong class="col-xs-12 col-sm-12 text-danger">{{ $errors->first('price_product') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div hide class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">List Product</label>
                            <div class="col-sm-9" id="product-promotion"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9 offset-sm-3">
                                <a href="{{route('promotions.index')}}" class="btn btn-danger">@lang('master.content.button.cancel')</a>
                                <button type="button" class="btn btn-primary " id="search-product">Search</button> 
                                <input type="submit" value="@lang('master.content.button.update')" id="create-promotion" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 