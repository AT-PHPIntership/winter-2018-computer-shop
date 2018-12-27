@extends('admin.layout.master')
@section('content')       
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header d-flex align-items-center">
        <h3 class="h4">Role Form</h3>
      </div>
      <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{ route('role.store') }}">
          @csrf
          <div class="form-group row">
            <label class="col-sm-3 form-control-label">Role Name</label>
            <div class="col-sm-9">
              <input id="inputHorizontalWarning" type="text" name="name" placeholder="Role Name" class="form-control">
              @if ($errors->has('name'))
                <span class="help-block col-sm-12">
                    <strong style='color:red' class="col-xs-12 col-sm-12">{{ $errors->first('name') }}</strong>
                </span>
              @endif
            </div>
          </div>
          <div class="form-group row">       
            <div class="col-sm-9 offset-sm-3">
              <input type="submit" value="Create" class="btn btn-primary">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection