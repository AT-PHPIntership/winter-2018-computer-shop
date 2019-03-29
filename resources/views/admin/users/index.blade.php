@extends('admin.layout.master')
@section('content')
<!-- Page Header-->
@include('admin.partials.header', ['title' => trans('master.sidebar.user')])
@include('admin.partials.message')
@include('admin.partials.warning')
<section class="tables">  
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <a href="{{route('users.create')}}" class="btn btn-primary">@lang('master.content.action.add', ['attribute' => trans('master.content.attribute.User')])</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">   
                            <table class="table table-striped table-sm text-center" id="user-table">
                                <thead>
                                    <tr>
                                        <th>@lang('master.content.table.id')</th>
                                        <th>@lang('master.content.table.email')</th>
                                        <th>@lang('master.content.form.name')</th>
                                        <th>@lang('master.content.table.role')</th>
                                        <th>@lang('master.content.table.status')</th>
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
