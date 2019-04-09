@extends('admin.layout.master')
@section('content')
@include('admin.partials.header', ['title' => trans('master.sidebar.order')])
@include('admin.partials.message')
@include('admin.partials.warning')
<section class="tables">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover text-center">
                                <thead>
                                    <tr >
                                        <th>@lang('master.content.table.id')</th>
                                        <th>@lang('master.content.table.user')</th>
                                        <th>@lang('master.content.table.phone')</th>
                                        <th>@lang('master.content.table.note')</th>
                                        <th>@lang('master.content.table.date_order')</th>
                                        <th>@lang('master.content.table.status')</th>
                                        @include('admin.partials.action_form', ['name' => config('constants.permissions.8'), 'edit' => config('constants.permission-actions.2'), 'delete' => config('constants.permission-actions.3')])
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <th>{{ $order->id }}</th>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->note }}</td>
                                        <td>{{ $order->date_order }}</td>
                                        <td>{{ $order->getCurrentStatusAttribute() }}</td>
                                        <td>
                                        @include('admin.partials.detail_button', ['route' => trans('master.content.attribute.order'), 'id' => $order->id])
                                        @include('admin.partials.edit_button', ['name' => config('constants.permissions.8'), 'action' => config('constants.permission-actions.2'), 'route' => trans('master.content.attribute.order'), 'id' => $order->id])
                                        @if($order->getCurrentStatusAttribute() == "Cancel")
                                            @include('admin.partials.delete_button', ['name' => config('constants.permissions.8'), 'action' => config('constants.permission-actions.3'), 'route' => trans('master.content.attribute.order'), 'id' => $order->id])
                                        @endIf
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{ $orders->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 