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
                        <a href="{{route('permissions.create')}}">
                            <button type="button" class="btn btn-primary">@lang('master.content.action.add', ['attribute' => 'Permission'])</button>
                        </a>
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
                                        <th>@lang('master.content.table.action')</th>
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
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <a href="{{route('permissions.edit', $permission->id)}}"><i class="ace-icon fa fa-edit"></i></a>
                                            </button>
                                            <form action="{{route('permissions.destroy', $permission->id)}}" method="POST" class="d-inline" onsubmit="return confirmedDelete('permission')">
                                                @csrf
                                                @method('DELETE') 
                                                <button type="submit" class="btn btn-danger btn-lg"><i class="ace-icon fa fa-trash"></i></button>
                                            </form>
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