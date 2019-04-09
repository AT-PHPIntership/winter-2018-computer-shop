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
                        @include('admin.partials.add_button', ['name' => config('constants.permissions.6'), 'action' => config('constants.permission-actions.0'), 'route' => trans('master.content.attribute.slide'), 'title' => trans('master.content.attribute.Slide')])
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">   
                            <table class="table table-striped table-sm text-center">
                                <thead>
                                    <tr>
                                        <th>@lang('master.content.table.id')</th>
                                        <th>@lang('master.content.form.image')</th>
                                        <th>@lang('master.content.table.display')</th>
                                        @include('admin.partials.action_form', ['name' => config('constants.permissions.6'), 'edit' => config('constants.permission-actions.2'), 'delete' => config('constants.permission-actions.3')])
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($slides as $slide)
                                    <tr class="display-banner" data-id="{{ $slide->id }}">
                                        <th class="category-index">{{ $slide->id }}</th>
                                        <td>
                                            <div class="image-item" data-id="{{$slide->id}}">
                                                <a href="storage/slides/{{$slide->name}}" data-lightbox="product">
                                                    <img src="storage/slides/{{$slide->name}}" width='125' height='60'>
                                                </a>
                                            </div>
                                        </td>
                                        <th class="category-index">                              
                                            <label class="checkbox-inline">
                                                @if($slide->flag == 1)
                                                    <input class="check-to-display" type="checkbox" value="" data-image-id="{{ $slide->id }}" data-token="{{csrf_token()}}" checked>
                                                @else
                                                    <input class="check-to-display" type="checkbox" value="" data-image-id="{{ $slide->id }}" data-token="{{csrf_token()}}">
                                                @endif
                                            </label>
                                        </th>
                                        @if ($permissions->pluck('slides_manage')->contains('slides_manage'))
                                        @if (Auth::user()->role->permissions->pluck('slides_manage')->contains('slides_manage'))
                                        @php $actionPermission = json_decode(Auth::user()->role->permissions->where('name', 'slides_manage')->first()->pivot->action_pivot) @endphp
                                        @if (in_array('delete', $actionPermission))
                                        <th class="category-index">
                                            <button type="button" class="btn btn-danger delete-banner" data-dismiss="alert" data-image-id="{{ $slide->id }}" data-token="{{csrf_token()}}">
                                                <i class="ace-icon fa fa-trash"></i>
                                            </button>
                                        </th>
                                        @endif
                                        @endif
                                        @else 
                                        <th class="category-index">
                                            <button type="button" class="btn btn-danger delete-banner" data-dismiss="alert" data-image-id="{{ $slide->id }}" data-token="{{csrf_token()}}">
                                                <i class="ace-icon fa fa-trash"></i>
                                            </button>
                                        </th>
                                        @endif
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
