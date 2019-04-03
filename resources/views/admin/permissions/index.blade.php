@extends('admin.layout.master')
@section('content')
@include('admin.partials.header', ['title' => trans('master.sidebar.permission')])
@include('admin.partials.message')
@include('admin.partials.warning')
<section class="tables">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        @include('admin.partials.add_button', ['name' => config('constants.permissions.3'), 'action' => config('constants.permission-actions.0'), 'route' => trans('master.content.attribute.permission')])
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>@lang('master.content.table.id')</th>
                                        <th>@lang('master.content.form.name')</th>
                                        <th>@lang('master.content.form.display')</th>
                                        <th>@lang('master.content.action.product.details')</th>
                                        @include('admin.partials.action_form', ['name' => config('constants.permissions.3'), 'edit' => config('constants.permission-actions.2'), 'delete' => config('constants.permission-actions.3')])
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($permissions as $key => $permission)
                                    <tr>
                                        <th>{{$permission->id}}</th>
                                        <td>{{$permission->name}}</td>
                                        <td>{{$permission->display_name}}</td>
                                        <td>
                                            @foreach(json_decode($permission->actions) as $action)
                                                <span class="pivot-action">{{ucfirst($action)}}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @include('admin.partials.edit_button', ['name' => config('constants.permissions.3'), 'action' => config('constants.permission-actions.2'), 'route' => trans('master.content.attribute.permission'), 'id' => $permission->id])

                                            @include('admin.partials.delete_button', ['name' => config('constants.permissions.3'), 'action' => config('constants.permission-actions.3'), 'route' => trans('master.content.attribute.permission'), 'id' => $permission->id])
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{$permissions->links()}}
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection 