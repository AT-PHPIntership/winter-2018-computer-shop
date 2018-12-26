@extends('admin.layout.master')
@section('content')       
  <div class="col-lg-12">
    <div class="card">
      <div class="card-close">
        <div class="dropdown">
          <button type="button" id="closeCard2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
          <div aria-labelledby="closeCard2" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
        </div>
      </div>
      <div class="card-header d-flex align-items-center">
        <h3 class="h4">Role Form</h3>
      </div>
      <div class="card-body">
        <form class="form-horizontal">
          <div class="form-group row">
            <label class="col-sm-3 form-control-label">Role Name</label>
            <div class="col-sm-9">
              <input id="inputHorizontalWarning" type="text" placeholder="Role Name" class="form-control form-control-warning">
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