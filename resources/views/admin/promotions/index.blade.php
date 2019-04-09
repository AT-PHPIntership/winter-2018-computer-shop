@extends('admin.layout.master')
@section('content')
@include('admin.partials.header', ['title' => trans('master.sidebar.promotion')])
@include('admin.partials.message')
@include('admin.partials.warning')
<section class="tables">
  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
              <div class="card">
                  <div class="card-header d-flex align-items-center">
                    @include('admin.partials.add_button', ['name' => config('constants.permissions.9'), 'action' => config('constants.permission-actions.0'), 'route' => trans('master.content.attribute.promotion'), 'title' => trans('master.content.attribute.Promotion')])
                  </div>
                  <div class="card-body">
                      <div class="table-responsive">
              <table class="table table-striped table-hover text-center">
                <thead>
                  <tr>
                    <th>@lang('master.content.table.id')</th>
                    <th>@lang('master.content.form.name')</th>
                    <th>@lang('master.content.table.percent')</th>
                    <th>@lang('master.content.table.start_at')</th>
                    <th>@lang('master.content.table.end_at')</th>
                    <th>@lang('master.content.attribute.Category')</th>
                    <th>@lang('master.content.table.total_sold')</th>
                    <th>@lang('master.content.table.product_price')</th>
                    @include('admin.partials.action_form', ['name' => config('constants.permissions.9'), 'edit' => config('constants.permission-actions.2'), 'delete' => config('constants.permission-actions.3')])
                  </tr>
                </thead>
                <tbody>

                @foreach($promotions as $promotion)
                <tr>
                    <th scope="row">{{ $promotion->id }}</th>
                    <td>{{ $promotion->name }}</td>
                    <td>{{ $promotion->percent }}</td>
                    <td>{{ $promotion->start_at }}</td>
                    <td>{{ $promotion->end_at }}</td>
                    @php foreach($categoriesChildren as $category) {
                          if($category->id === $promotion->category_id) {
                    @endphp
                      <td>{{ $category->name }}</td>
                    @php }}@endphp
                    <td>{{ $promotion->total_sold }}</td>
                    <td>{{number_format($promotion->price_product,0,",",".") . ' đ'}}</td>
                    <td>
                      @include('admin.partials.edit_button', ['name' => config('constants.permissions.9'), 'action' => config('constants.permission-actions.2'), 'route' => trans('master.content.attribute.promotion'), 'id' => $promotion->id])
                      @include('admin.partials.delete_button', ['name' => config('constants.permissions.9'), 'action' => config('constants.permission-actions.3'), 'route' => trans('master.content.attribute.promotion'), 'id' => $promotion->id])
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="row">
              <div class="col-md-12">
              {{ $promotions->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
