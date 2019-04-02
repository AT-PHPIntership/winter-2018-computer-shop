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
          <form class="form-horizontal" method="POST" action="{{ route('roles.update', $role->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group row">
              <label class="col-sm-3 form-control-label">@lang('master.content.form.name')</label>
              <div class="col-sm-9">
                <input id="inputHorizontalWarning" type="text" name="name" placeholder="Role Name" class="form-control" value="{{ $role->name }}" required>
                @if ($errors->has('name'))
                  <span class="help-block col-sm-12">
                      <strong class="col-xs-12 col-sm-12 text-danger">{{ $errors->first('name') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 form-control-label">@lang('master.content.attribute.Permission')</label>
                <div class="col-sm-9 replace-by-input">
                  @foreach($permissions as $key => $permission)
                  @if (count($role->permissions) > 0)
                    @if (count($role->permissions->where('id', $permission->id)) > 0 )
                      @php $value = $role->permissions->where('id', $permission->id)->first()->pivot->action_pivot @endphp
                    @else 
                      @php $value = '' @endphp
                    @endif
                  <div class="choose-permission">
                    <input name="permission-{{$permission->id}}" class="permission-{{$key}} checkAll" type="checkbox" data-permission-id={{$permission->id}} {{($role->permissions->pluck('id')->contains($permission->id)) ? "checked=checked value=$value " : ''}}>
                    <a href="" data-toggle="collapse" data-target="#collapse-{{$key}}" aria-expanded="false" aria-controls="collapseExample">{{$permission->display_name}}</a>
                  </div>
                  <div class="detail-permission">
                    @foreach(json_decode($permission->actions) as $action)
                    <div class="collapse" id="collapse-{{$key}}" data-count-action='{{count(json_decode($permission->actions))}}' data-permission-id="{{$permission->id}}" >
                      <input class="check-{{$permission->id}} uncheckAll" type="checkbox" data-key="{{$key}}" data-value="{{$action}}" {{($value != '') ? ((in_array($action ,json_decode($value))) ? 'checked=checked ' : '') : '' }}>    
                      <span>{{ucfirst($action)}}</span>
                    </div>
                    @endforeach
                  </div>
                  @else
                  <div class="choose-permission">
                    <input name="permission-{{$permission->id}}" class="permission-{{$key}} checkAll" type="checkbox" data-permission-id={{$permission->id}}>
                    <a href="" data-toggle="collapse" data-target="#collapse-{{$key}}" aria-expanded="false" aria-controls="collapseExample">{{$permission->display_name}}</a>
                  </div>
                  <div class="detail-permission">
                    @foreach(json_decode($permission->actions) as $action)
                    <div class="collapse" id="collapse-{{$key}}" data-count-action='{{count(json_decode($permission->actions))}}' data-permission-id="{{$permission->id}}" >
                      <input class="check-{{$permission->id}} uncheckAll" type="checkbox" data-key="{{$key}}" data-value="{{$action}}">    
                      <span>{{ucfirst($action)}}</span>
                    </div>
                    @endforeach
                  </div>
                  @endif
                  @endforeach
                </div>
            </div>
            <div class="form-group row">       
              <div class="col-sm-9 offset-sm-3">
                <a href="{{route('roles.index')}}" class="btn btn-danger">@lang('master.content.button.cancel')</a>
                <input type="submit" value="Update" class="btn btn-primary">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection