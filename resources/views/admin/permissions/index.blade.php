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
                        @can('permission_manage')
                        <a href="{{route('permissions.create')}}">
                            <button type="button" class="btn btn-primary">@lang('master.content.action.add', ['attribute' => 'Permission'])</button>
                        </a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>@lang('master.content.table.id')</th>
                                        <th>@lang('master.content.form.name')</th>
                                        @foreach($roles as $role)
                                            <th>{{$role->name}}</th>
                                        @endforeach
                                        @can('permission_manage')
                                        <th>@lang('master.content.table.action')</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($permissions as $key => $permission)
                                    <tr>
                                        <th class="permission-{{$key}}">{{$permission->id}}</th>
                                        <td ><a href="" data-toggle="collapse" data-target="#collapse-{{$key}}" aria-expanded="false" aria-controls="collapseExample">{{$permission->display_name}}</a></td>
                                        @foreach($roles as $role)
                                            <td><input class="permission-{{$key}}-{{$role->id}} checked-{{$key}} checkAll" type="checkbox" data-role-id="{{$role->id}}" data-key="{{$key}}" {{($role->permissions->pluck('id')->contains($permission->id) ? "checked='checked'" : '')}}></td>
                                        @endforeach
                                        <td>
                                            @can('permission_manage')
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <a href="{{route('permissions.edit', $permission->id)}}"><i class="ace-icon fa fa-edit"></i></a>
                                            </button>
                                            <form action="{{route('permissions.destroy', $permission->id)}}" method="POST" class="d-inline" onsubmit="return confirmedDelete('permission')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-lg"><i class="ace-icon fa fa-trash"></i></button>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>
                                    @if (!is_null($permission->actions))
                                    @foreach(json_decode($permission->actions) as $action)
                                    <tr class="collapse" id="collapse-{{$key}}" data-count-action='{{count(json_decode($permission->actions))}}' data-permission-id="{{$permission->id}}">
                                        <td></td>
                                        <td>{{ucfirst($action)}}</td>
                                        @foreach($roles as $role)
                                            <td><input class="check-{{$role->id}}-{{$permission->id}} uncheckAll" type="checkbox" data-key="{{$key}}" data-role-id="{{$role->id}}" data-value="{{$action}}" {{($role->permissions->pluck('id')->contains($permission->id) ? "checked='checked'" : '')}}>
                                            </td>
                                        @endforeach
                                        <td>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{$permissions->links()}}
                            </div>
                        </div>
                        <button type="button" class="btn btn-success save-permission"  data-amount-permission="{{$permissions->count()}}" data-token="{{csrf_token()}}" data-role-id="{{$roles->pluck('id')}}">
                            <i class="ace-icon fa fa-save"></i>&nbsp;<span>@lang('master.content.table.save')</span>
                        </button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection 