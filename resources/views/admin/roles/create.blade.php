@extends('admin.layout.master')
@section('content')
<header class="page-header">
   <div class="container-fluid">
       <h2 class="no-margin-bottom">@lang('master.sidebar.role')</h2>
   </div>
</header>
<!-- Breadcrumb-->
<div  class="breadcrumb-holder container-fluid">
   <ul class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('admin.home')}}">@lang('master.sidebar.home')</a></li>
       <li class="breadcrumb-item active">@lang('master.sidebar.role')</li>
   </ul>
</div>

<section class="tables">
   <div class="container-fluid">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <form class="form-horizontal" method="POST" action="{{ route('roles.store') }}">
            @csrf
            <div class="form-group row">
              <label class="col-sm-3 form-control-label">@lang('master.content.form.name')</label>
              <div class="col-sm-9">
                <input id="inputHorizontalWarning" type="text" name="name" placeholder="Role Name" class="form-control" value="{{ old('name') }}" required>
                @if ($errors->has('name'))
                  <span class="help-block col-sm-12">
                      <strong class="col-xs-12 col-sm-12 text-danger">{{ $errors->first('name') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">       
              <div class="col-sm-9 offset-sm-3">
                <a href="{{route('roles.index')}}" class="btn btn-danger">@lang('master.content.button.cancel')</a>
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