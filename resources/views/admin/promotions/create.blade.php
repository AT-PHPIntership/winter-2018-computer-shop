@extends('admin.layout.master')
@section('content')
<header class="page-header">
   <div class="container-fluid">
       <h2 class="no-margin-bottom">@lang('master.sidebar.promotion')</h2>
   </div>
</header>
<!-- Breadcrumb-->
<div  class="breadcrumb-holder container-fluid">
   <ul class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('admin.home')}}">@lang('master.sidebar.home')</a></li>
       <li class="breadcrumb-item active">@lang('master.sidebar.promotion')</li>
   </ul>
</div>

<section class="tables">
   <div class="container-fluid">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <form class="form-horizontal" method="POST" action="{{ route('promotions.store') }}">
            @csrf
            <div class="form-group row">
              <label class="col-sm-3 form-control-label">@lang('master.content.form.name')</label>
              <div class="col-sm-9">
                <input id="inputHorizontalWarning" type="text" name="name" placeholder="Name" class="form-control" value="{{ old('name') }}">
                @if ($errors->has('name'))
                  <span class="help-block col-sm-12">
                      <strong class="col-xs-12 col-sm-12 text-danger">{{ $errors->first('name') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 form-control-label">@lang('master.content.table.percent')</label>
              <div class="col-sm-9">
                <input id="inputHorizontalWarning" type="text" name="percent" placeholder="Percent" class="form-control" value="{{ old('percent') }}">
                @if ($errors->has('percent'))
                  <span class="help-block col-sm-12">
                      <strong class="col-xs-12 col-sm-12 text-danger">{{ $errors->first('percent') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 form-control-label">@lang('master.content.table.start_at')</label>
              <div class="col-sm-9">
                <input type="date" name="start_at" value="{{ old('start_at')}}">
                @if ($errors->has('start_at'))
                  <span class="help-block col-sm-12">
                      <strong class="col-xs-12 col-sm-12 text-danger">{{ $errors->first('start_at') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 form-control-label">@lang('master.content.table.end_at')</label>
              <div class="col-sm-9">
                <input type="date" name="end_at" value="{{ old('end_at') }}">
                @if ($errors->has('end_at'))
                  <span class="help-block col-sm-12">
                      <strong class="col-xs-12 col-sm-12 text-danger">{{ $errors->first('end_at') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 form-control-label">@lang('master.content.table.total_sold')</label>
              <div class="col-sm-9">
                <input id="inputHorizontalWarning" type="text" name="total_sold" placeholder="Total Sold" class="form-control" value="{{ old('total_sold') }}">
                @if ($errors->has('total_sold'))
                  <span class="help-block col-sm-12">
                      <strong class="col-xs-12 col-sm-12 text-danger">{{ $errors->first('total_sold') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">       
              <div class="col-sm-9 offset-sm-3">
                <input type="submit" value="@lang('master.content.button.create')" class="btn btn-primary">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection