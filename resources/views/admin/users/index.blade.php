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
                        <a href="{{route('users.create')}}" class="btn btn-primary">@lang('master.content.action.add', ['attribute' => 'User'])</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">   
                            <table class="table table-striped table-sm text-center">
                                <thead>
                                    <tr>
                                        <th>@lang('master.content.table.id')</th>
                                        <th>@lang('master.content.table.email')</th>
                                        <th>@lang('master.content.form.name')</th>
                                        <th>@lang('master.content.table.role')</th>
                                        <th>@lang('master.content.table.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <th scope="row">{{$user->id}}</th>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->roles->name}}</td>
                                        <td>
                                            <a href="{{route('users.show', $user->id)}}" class="btn btn-info btn-sm">@lang('master.content.action.detail', ['attribute' => 'User'])</a>
                                            <a href="" class="btn btn-warning btn-sm">@lang('master.content.action.edit', ['attribute' => 'User'])</a>
                                            <form action="{{route('users.destroy', $user->id)}}" method="POST" class="d-inline" onsubmit="return ConfirmDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">@lang('master.content.action.delete', ['attribute' => 'User'])</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('admin.partials.paginate', ['paginate' => $users])
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
