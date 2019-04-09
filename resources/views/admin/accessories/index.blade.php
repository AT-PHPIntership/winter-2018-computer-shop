@extends('admin.layout.master')
@section('content')
@include('admin.partials.header', ['title' => trans('master.sidebar.accessory')])
@include('admin.partials.message')
@include('admin.partials.warning')
<section class="tables">
  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
              <div class="card">
                  <div class="card-header d-flex align-items-center">
                    @include('admin.partials.add_button', ['name' => config('constants.permissions.11'), 'action' => config('constants.permission-actions.0'), 'route' => trans('master.content.attribute.accessory'), 'title' => trans('master.content.attribute.Accessory')])
                  </div>
                  <div class="card-body">
                      <div class="table-responsive">
              <table class="table table-striped table-hover text-center">
                <thead>
                  <tr>
                    <th>@lang('master.content.table.id')</th>
                    <th>@lang('master.content.form.name')</th>
                    @include('admin.partials.action_form', ['name' => config('constants.permissions.11'), 'edit' => config('constants.permission-actions.2'), 'delete' => config('constants.permission-actions.3')])
                  </tr>
                </thead>
                <tbody>
                @foreach($accessories as $accessory)
                <tr>
                    <th scope="row">{{ $accessory->id }}</th>
                    <td>{{ $accessory->name }}</td>
                    <td>
                      @if(sizeof($accessory->children) > 0)
                        @include('admin.partials.detail_button', ['route' => trans('master.content.attribute.accessory'), 'id' => $accessory->id])
                      @endif
                        @include('admin.partials.edit_button', ['name' => config('constants.permissions.11'), 'action' => config('constants.permission-actions.2'), 'route' => trans('master.content.attribute.accessory'), 'id' => $accessory->id])
                      @if(sizeof($accessory->children) == 0)
                        @include('admin.partials.delete_button', ['name' => config('constants.permissions.11'), 'action' => config('constants.permission-actions.3'), 'route' => trans('master.content.attribute.accessory'), 'id' => $accessory->id])
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="row">
              <div class="col-md-12">
              {{$accessories->links()}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
