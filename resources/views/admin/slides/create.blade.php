@extends('admin.layout.master')
@section('content')
<!-- Page Header-->
@include('admin.partials.header', ['title' => trans('master.sidebar.slide')])
@include('admin.partials.warning')
<!-- Forms Section-->
<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <a href="{{route('slides.index')}}" class="btn btn-success rounded-circle mr-1"><i class="fa fa-arrow-left"></i></a>
            <h3 class="h4">@lang('master.content.action.add', ['attribute' => trans('master.content.attribute.Slide')])</h3>
          </div>
          <div class="card-body">
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.image')</label>
                <form action="{{route('slides.store')}}" method="post" class="dropzone" id="dropzone" enctype="multipart/form-data">
                  @csrf
                </form>
                @include('admin.partials.error', ['err' => 'name'])
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
