@extends('admin.layout.master')
@section('content')
@include('admin.partials.header', ['title' => trans('master.sidebar.role')])
@include('admin.partials.message')
@include('admin.partials.warning')
<section class="tables">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        @include('admin.partials.add_button', ['name' => config('constants.permissions.2'), 'action' => config('constants.permission-actions.0'), 'route' => trans('master.content.attribute.role'), 'title' => trans('master.content.attribute.Role')])
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>@lang('master.content.table.id')</th>
                                        <th>@lang('master.content.form.name')</th>
                                        @include('admin.partials.action_form', ['name' => config('constants.permissions.2'), 'edit' => config('constants.permission-actions.2'), 'delete' => config('constants.permission-actions.3')])
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $key => $role)
                                    <tr>
                                        <th>{{ $role->id }}</th>
                                        <td><a href="" data-toggle="collapse" data-target="#collapse-{{$key}}" aria-expanded="false" aria-controls="collapseExample">{{ $role->name }}</a></td>
                                        <td>
                                            @include('admin.partials.edit_button', ['name' => config('constants.permissions.2'), 'action' => config('constants.permission-actions.2'), 'route' => trans('master.content.attribute.role'), 'id' => $role->id])
                                            @if ($role->name != 'Admin')
                                                @include('admin.partials.delete_button', ['name' => config('constants.permissions.2'), 'action' => config('constants.permission-actions.3'), 'route' => trans('master.content.attribute.role'), 'id' => $role->id])
                                            @endif
                                        </td>
                                    </tr>
                                    @foreach($role->permissions as $permission)
                                    <tr class="collapse" id="collapse-{{$key}}" data-count-action='{{count(json_decode($permission->actions))}}' data-permission-id="{{$permission->id}}">
                                        <td></td>
                                        <td>{{$permission->display_name}}: @foreach(json_decode($permission->pivot->action_pivot) as $action) <span class="pivot-action">{{ucfirst($action)}}</span>@endforeach</td>
                                        <td>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{$roles->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 