@extends('admin.layout.master')
@section('content')
<!-- Page Header-->
@include('admin.partials.header', ['title' => trans('master.sidebar.category')])
@include('admin.partials.message')
@include('admin.partials.warning')
<section class="tables">  
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <a href="{{route('categories.create')}}" class="btn btn-primary">@lang('master.content.action.add', ['attribute' => trans('master.content.attribute.Category')])</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">   
                            <table class="table table-striped table-sm text-center">
                                <thead>
                                    <tr>
                                        <th>@lang('master.content.table.id')</th>
                                        <th>@lang('master.content.form.name')</th>
                                        <th>@lang('master.content.table.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                    <tr>
                                        <th scope="row">{{$category->id}}</th>
                                        <td>{{$category->name}}</td>
                                        <td>
                                            <a href="{{route('categories.show', $category->id)}}" class="btn btn-info btn-sm">@lang('master.content.action.detail')</a>
                                            <a href="{{route('categories.edit', $category->id)}}" class="btn btn-warning btn-sm">@lang('master.content.action.edit', ['attribute' => trans('master.content.attribute.Category')])</a>
                                            <form action="{{route('categories.destroy', $category->id)}}" method="POST" class="d-inline" onsubmit="return confirmedDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">@lang('master.content.action.delete', ['attribute' => trans('master.content.attribute.Category')])</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
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
