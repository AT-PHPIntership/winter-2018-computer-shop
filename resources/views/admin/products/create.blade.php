@extends('admin.layout.master')
@section('content')
<!-- Page Header-->
@include('admin.partials.header', ['title' => trans('master.sidebar.product')])
@include('admin.partials.warning')
<!-- Forms Section-->
<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">@lang('master.content.action.add', ['attribute' => trans('master.content.table.product')])</h3>
          </div>
          <div class="card-body">
            <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.name')<span class="ml-1 text-danger">*<span></label>
                <input name="name" type="text" placeholder="Enter product name" class="form-control" value="{{ old('name') }}">
                @include('admin.partials.error', ['err' => 'name'])
              </div>
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.description')</label>
                <textarea name='description' id='demo' class="form-control ckeditor" rows="4" value="">{{old('description')}}</textarea>
              </div>
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.price')<span class="ml-1 text-danger">*<span></label>
                <input name="unit_price" type="text" placeholder="Enter product price" class="form-control" value="{{ old('unit_price') }}" id='formatCurrency'>
                @include('admin.partials.error', ['err' => 'unit_price'])
              </div>
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.quantity')<span class="ml-1 text-danger">*<span></label>
                <input name="quantity" type="number" placeholder="Enter product quantity" class="form-control" value="{{ old('quantity') }}">
                @include('admin.partials.error', ['err' => 'quantity'])
              </div>
              <div class="form-group">
                <label class="form-control-label">@lang('master.content.form.image')</label>
                <input name="images[]" type="file" multiple="multiple" class="form-control" value="">
                @include('admin.partials.error', ['err' => 'images.*'])
              </div>
              <div class="form-group row">
                <label class="form-control-label col-sm-12">@lang('master.content.form.category')<span class="ml-1 text-danger">*<span></label>
                <div class="col-sm-12">
                  <select name='parent_category' class="form-control mb-3" id='parent_category'>
                    <option value="" selected disabled hidden>@lang('master.content.select.choose')</option>
                    @foreach($categories as $category)
                        <option {{ (old('parent_category') == $category->id) ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
                  @include('admin.partials.error', ['err' => 'category_id'])
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12" id="child_category">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">@lang('master.content.table.ram')</label>
                <div class="col-sm-9">
                  <select name="accessory_id[]" class="form-control mb-3">
                    <option value="" selected disabled hidden>@lang('master.content.select.choose')</option>
                    @foreach($accessories->where('name', trans('master.content.table.ram')) as $rams)
                      @foreach($rams->childrens as $ram)
                        <option <?php echo (old('accessory_id.0') == $ram->id) ? 'selected' : ''?> value="{{$ram->id}}">{{$ram->name}}</option>
                      @endforeach
                    @endforeach
                  </select>
                  @include('admin.partials.error', ['err' => 'accessory_id.0'])
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">@lang('master.content.table.cpu')</label>
                <div class="col-sm-9">
                  <select name="accessory_id[]" class="form-control mb-3">
                    <option value="" selected disabled hidden>@lang('master.content.select.choose')</option>
                    @foreach($accessories->where('name', trans('master.content.table.cpu')) as $cpus)
                      @foreach($cpus->childrens as $cpu)
                        <option <?php echo (old('accessory_id.1') == $cpu->id) ? 'selected' : ''?> value="{{$cpu->id}}">{{$cpu->name}}</option>
                      @endforeach
                    @endforeach
                  </select>
                  @include('admin.partials.error', ['err' => 'accessory_id.1'])
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">@lang('master.content.table.hdd')</label>
                <div class="col-sm-9">
                  <select name="accessory_id[]" class="form-control mb-3">
                    <option value="" selected disabled hidden>@lang('master.content.select.choose')</option>
                    @foreach($accessories->where('name', trans('master.content.table.hdd')) as $hdds)
                      @foreach($hdds->childrens as $hdd)
                        <option <?php echo (old('accessory_id.2') == $hdd->id) ? 'selected' : ''?> value="{{$hdd->id}}">{{$hdd->name}}</option>
                      @endforeach
                    @endforeach
                  </select>
                  @include('admin.partials.error', ['err' => 'accessory_id.2'])
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">@lang('master.content.table.monitor')</label>
                <div class="col-sm-9">
                  <select name="accessory_id[]" class="form-control mb-3">
                    <option value="" selected disabled hidden>@lang('master.content.select.choose')</option>
                    @foreach($accessories->where('name', trans('master.content.table.monitor')) as $monitors)
                      @foreach($monitors->childrens as $monitor)
                        <option <?php echo (old('accessory_id.3') == $monitor->id) ? 'selected' : ''?> value="{{$monitor->id}}">{{$monitor->name}}</option>
                      @endforeach
                    @endforeach
                  </select>
                  @include('admin.partials.error', ['err' => 'accessory_id.3'])
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">@lang('master.content.table.gpu')</label>
                <div class="col-sm-9">
                  <select name="accessory_id[]" class="form-control mb-3">
                    <option value="" selected disabled hidden>@lang('master.content.select.choose')</option>
                    @foreach($accessories->where('name', trans('master.content.table.gpu')) as $gpus)
                      @foreach($gpus->childrens as $gpu)
                        <option <?php echo (old('accessory_id.4') == $gpu->id) ? 'selected' : ''?> value="{{$gpu->id}}">{{$gpu->name}}</option>
                      @endforeach
                    @endforeach
                  </select>
                  @include('admin.partials.error', ['err' => 'accessory_id.4'])
                </div>
              </div>
              <div class="form-group">    
                <a href="{{route('products.index')}}" class="btn btn-danger">@lang('master.content.button.cancel')</a>
                <input type="submit" value="@lang('master.content.button.create')" class="btn btn-primary">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
