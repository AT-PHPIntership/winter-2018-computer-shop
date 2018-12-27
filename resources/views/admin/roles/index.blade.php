@extends('admin.layout.master')
@section('content')
<div class="col-lg-12">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h2 class="h2">Roles Management</h2>
  <div class="btn-toolbar mb-2 mb-md-0">
    <a href="{{route('role.create')}}" class="btn btn-sm btn-secondary">
      Add Role
    </a>
  </div>
</div>
@if(session('message'))
        <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
            {{session('message')}}
        </div>
    @endif
  <div class="card">
    
    <div class="card-header d-flex align-items-center">
      <h3 class="h4">Roles list</h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">                       
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Role Name</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Admin</td>
              <td>
                <a href="{{route('role.create')}}" class="btn btn-sm btn-primary">
                  Edit
                </a>
                <a href="{{route('role.create')}}" class="btn btn-sm btn-danger">
                  Delete
                </a>
              </td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Admin</td>
              <td>
                <a href="{{route('role.create')}}" class="btn btn-sm btn-primary">
                  Edit
                </a>
                <a href="{{route('role.create')}}" class="btn btn-sm btn-danger">
                  Delete
                </a>
              </td>
            </tr>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
