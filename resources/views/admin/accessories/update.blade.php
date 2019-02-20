@extends('admin.layout.master')
@section('content')
<header class="page-header">
   <div class="container-fluid">
       <h2 class="no-margin-bottom">@lang('master.sidebar.accessory')</h2>
   </div>
</header>
<!-- Breadcrumb-->
<div  class="breadcrumb-holder container-fluid">
   <ul class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('admin.home')}}">@lang('master.sidebar.home')</a></li>
       <li class="breadcrumb-item active">@lang('master.sidebar.accessory')</li>
   </ul>
</div>

<section class="tables">
   <div class="container-fluid">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <form class="form-horizontal" method="POST" action="{{ route('accessories.update', $accessory->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group row">
              <label class="col-sm-3 form-control-label">@lang('master.content.form.name')</label>
              <div class="col-sm-9">
                <input id="inputHorizontalWarning" type="text" name="name" placeholder="Name" class="form-control" value="{{ old('name') ? old('name') : $accessory->name }}" required>
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
                  @if($accessory->parent_id == null)
                        <option value="" <?php echo 'selected' ?> disabled hidden>@lang('master.content.select.choose')</option>
                    @foreach($parentAccessories as $main_accessory)
                      @if ($main_accessory->id != $accessory->id)
                        <option value="{{$main_accessory->id}}">{{$main_accessory->name}}</option>
                      @endif
                    @endforeach
                    @else
                      <option value="">@lang('master.content.select.parent')</option>
                    @foreach($parentAccessories as $sub_accessory)
                        <option <?php echo ($sub_accessory->id == $accessory->parent_id) ? 'selected' : '' ?> value="{{$sub_accessory->id}}">{{$sub_accessory->name}}</option>
                    @endforeach
                  @endif
                  </select>
                @if ($errors->has('parent_id'))
                  <span class="help-block col-sm-12">
                      <strong class="col-xs-12 col-sm-12 text-danger">{{ $errors->first('parent_id') }}</strong>
                  </span>
                @endif
                </div>
              </div>
            <div class="form-group row">       
              <div class="col-sm-9 offset-sm-3">
                <a href="{{URL::previous()}}" class="btn btn-danger">@lang('master.content.button.cancel')</a>
                <input type="submit" value="@lang('master.content.button.update')" class="btn btn-primary">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection