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
                                        <th>@lang('master.content.form.image')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>
                                       <div class="form-group">
                                        <div class="col-sm-12 image-list" id="image-list">
                                            @foreach($slides as $slide)
                                            <div class="image-item" data-id="{{$slide->id}}">
                                              <a href="storage/slide/{{$slide->name}}" data-lightbox="product">
                                                 <img src="storage/slide/{{$slide->name}}" width='125' height='60'>
                                             </a>
                                              <button type="button" class="btn btn-danger btn-sm fa fa-minus-circle button-image" value="{{$slide->name}}" data-token="{{ csrf_token() }}" data-image-id="{{$slide->id}}"></button>
                                            </div>
                                             @endforeach
                                        </div>
                                      </div>
                                     </td>
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
