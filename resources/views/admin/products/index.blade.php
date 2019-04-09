@extends('admin.layout.master')
@section('content')
@include('admin.partials.header', ['title' => trans('master.sidebar.product')])
@include('admin.partials.message')
@include('admin.partials.warning')
<section class="tables">  
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-close">
                    <div class="dropdown">
                        <button class="btn btn-success btn-lg fa fa-upload" id="uploadFile"></button>
                    </div>
                    </div>
                    <div class="card-header d-flex align-items-center">
                        @include('admin.partials.add_button', ['name' => config('constants.permissions.5'), 'action' => config('constants.permission-actions.0'), 'route' => trans('master.content.attribute.product'), 'title' => trans('master.content.attribute.Product')])
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">   
                            <table class="table table-striped table-sm text-center" id="product-table">
                                <thead>
                                    <tr>
                                        <th>@lang('master.content.table.id')</th>
                                        <th>@lang('master.content.form.name')</th>
                                        <th>@lang('master.content.form.category')</th>
                                        <th>@lang('master.content.form.price')</th>
                                        <th>@lang('master.content.form.discount')</th>
                                        <th>@lang('master.content.form.sold')</th>
                                        <th>@lang('master.content.table.action')</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
