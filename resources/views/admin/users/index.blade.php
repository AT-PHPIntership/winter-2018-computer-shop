@extends('admin.layout.master')
@section('content')
<!-- Page Header-->
@include('admin.partials.header', ['title' => "Users Management"])
<section class="tables">  
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <button type="button" class="btn btn-primary"><a href="{{route('users.create')}}" style="text-decoration:none; color:#fff ">@lang('master.content.action.add', ['attribute' => 'User'])</a></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">   
                            <table class="table table-striped table-sm" style="text-align:center">
                                <thead>
                                    <tr>
                                        <th>@lang('master.content.table.id')</th>
                                        <th>@lang('master.content.table.email')</th>
                                        <th>@lang('master.content.table.role')</th>
                                        <th>@lang('master.content.table.active')</th>
                                        <th>@lang('master.content.table.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>mark@gmail.com</td>
                                        <td>Admin</td>
                                        <td>Yes</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm">@lang('master.content.action.detail', ['attribute' => 'User'])</button>
                                            <button type="button" class="btn btn-warning btn-sm">@lang('master.content.action.edit', ['attribute' => 'User'])</button>
                                            <button type="button" class="btn btn-danger btn-sm">@lang('master.content.action.delete', ['attribute' => 'User'])</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
