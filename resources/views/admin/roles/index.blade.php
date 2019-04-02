@extends('admin.layout.master')
@section('content')
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">@lang('master.sidebar.role')</h2>
    </div>
</header>
<!-- Breadcrumb-->
<div class="breadcrumb-holder container-fluid">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">@lang('master.sidebar.home')</a></li>
        <li class="breadcrumb-item active">@lang('master.sidebar.role')</li>
    </ul>
</div>
@if(session('message'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">
        <i class="ace-icon fa fa-times"></i>
    </button>
    {{session('message')}}
</div>
@endif
@if(session('warning'))
<div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert">
        <i class="ace-icon fa fa-times"></i>
    </button>
    {{session('warning')}}
</div>
@endif
<section class="tables">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <a href="{{route('roles.create')}}">
                            <button type="button" class="btn btn-primary">@lang('master.content.action.add', ['attribute' => 'Role'])</button>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>@lang('master.content.table.id')</th>
                                        <th>@lang('master.content.form.name')</th>
                                        <th>@lang('master.content.table.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $key => $role)
                                    <tr>
                                        <th>{{ $role->id }}</th>
                                        <td><a href="" data-toggle="collapse" data-target="#collapse-{{$key}}" aria-expanded="false" aria-controls="collapseExample">{{ $role->name }}</a></td>
                                        <td>
                                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning">
                                                @lang('master.content.action.edit', ['attribute' => 'Role'])
                                            </a>
                                            @if ($role->name != 'Admin')
                                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline" onsubmit="return confirmedDelete('role')">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="@lang('master.content.action.delete', ['attribute' => 'Role'])" class="btn btn-sm btn-danger">
                                            </form>
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