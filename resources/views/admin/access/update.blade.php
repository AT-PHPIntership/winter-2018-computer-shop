@extends('admin.layout.master')
@section('content')
<header class="page-header">
   <div class="container-fluid">
       <h2 class="no-margin-bottom">@lang('master.sidebar.access')</h2>
   </div>
</header>
<!-- Breadcrumb-->
<div  class="breadcrumb-holder container-fluid">
   <ul class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('admin.home')}}">@lang('master.sidebar.home')</a></li>
       <li class="breadcrumb-item active">@lang('master.sidebar.access')</li>
   </ul>
</div>

<section class="tables">
   <div class="container-fluid">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <form class="form-horizontal" method="POST" action="{{ route('access.update', $acces->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group row">
              <label class="col-sm-3 form-control-label">@lang('master.content.form.name')</label>
              <div class="col-sm-9">
                <input id="inputHorizontalWarning" type="text" name="name" placeholder="Name" class="form-control" value="{{ old('name') ? old('name') : $acces->name }}">
                @if ($errors->has('name'))
                  <span class="help-block col-sm-12">
                      <strong class="col-xs-12 col-sm-12 text-danger">{{ $errors->first('name') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 form-control-label">@lang('master.content.table.parent_id')</label>
                <div class="col-sm-9">
                  <select name="parent_id" class="form-control mb-3">
                      @if($acces->parent === null)
                      <option value="">No</option>
                      @else
                      <option value="{{ $acces->parent->id }}">{{ $acces->parent->name }}</option>
                      @endif
                      @foreach($access as $item)
                        @if($acces->id !== $item->id)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endif
                      @endforeach
                  </select>
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