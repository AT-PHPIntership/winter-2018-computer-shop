@extends('admin.layout.master')
@section('content')
<!-- Page Header-->
@include('admin.partials.header', ['title' => trans('master.sidebar.slide')])
@include('admin.partials.message')
@include('admin.partials.warning')
<section class="tables">  
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <a href="{{route('slides.create')}}" class="btn btn-primary">@lang('master.content.action.add', ['attribute' => trans('master.content.attribute.Slide')])</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">   
                            <table class="table table-striped table-sm text-center">
                                <thead>
                                    <tr>
                                        <th>@lang('master.content.table.id')</th>
                                        <th>@lang('master.content.form.image')</th>
                                        <th>@lang('master.content.table.display')</th>
                                        <th>@lang('master.content.table.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($slides as $slide)
                                    <tr class="display-banner" data-id="{{ $slide->id }}">
                                        <th class="category-index">{{ $slide->id }}</th>
                                        <td>
                                            <div class="image-item" data-id="{{$slide->id}}">
                                                <a href="storage/slide/{{$slide->name}}" data-lightbox="product">
                                                    <img src="storage/slide/{{$slide->name}}" width='125' height='60'>
                                                </a>
                                            </div>
                                        </td>
                                        <th class="category-index">                              
                                            <label class="checkbox-inline">
                                                <input class="check-to-display" type="checkbox" value="" data-image-id="{{ $slide->id }}" data-token="{{csrf_token()}}">
                                            </label>
                                        </th>
                                        <th class="category-index">
                                            <button type="button" class="btn btn-danger delete-banner" data-dismiss="alert" data-image-id="{{ $slide->id }}" data-token="{{csrf_token()}}">
                                                <i class="ace-icon fa fa-trash"></i>
                                            </button>
                                        </th>
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
