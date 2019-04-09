@extends('admin.layout.master')
@section('content')
@include('admin.partials.header', ['title' => trans('master.sidebar.code')])
@include('admin.partials.message')
@include('admin.partials.warning')
<section class="tables">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        @include('admin.partials.add_button', ['name' => config('constants.permissions.10'), 'action' => config('constants.permission-actions.0'), 'route' => trans('master.content.attribute.code'), 'title' => trans('master.content.attribute.Code')])
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>@lang('master.content.table.id')</th>
                                        <th>@lang('master.content.form.name')</th>
                                        <th>@lang('master.content.table.amount')</th>
                                        <th>@lang('master.content.table.start_at')</th>
                                        <th>@lang('master.content.table.end_at')</th>
                                        <th>@lang('master.content.table.order_month')</th>
                                        <th>@lang('master.content.table.all_user')</th>
                                        @include('admin.partials.action_form', ['name' => config('constants.permissions.10'), 'edit' => config('constants.permission-actions.2'), 'delete' => config('constants.permission-actions.3')])
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($codes as $code)
                                    <tr>
                                        <th scope="row">{{ $code->id }}</th>
                                        <td>{{ $code->name }}</td>
                                        <td>{{ $code->amount }}</td>
                                        <td>{{ $code->start_at }}</td>
                                        <td>{{ $code->end_at }}</td>
                                        <td>{{ $code->order_month }}</td>
                                        <td>{{ $code->all_user }}</td>
                                        <td>
                                        @include('admin.partials.edit_button', ['name' => config('constants.permissions.10'), 'action' => config('constants.permission-actions.2'), 'route' => trans('master.content.attribute.code'), 'id' => $code->id])
                                        @include('admin.partials.delete_button', ['name' => config('constants.permissions.10'), 'action' => config('constants.permission-actions.3'), 'route' => trans('master.content.attribute.code'), 'id' => $code->id])
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{ $codes->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 