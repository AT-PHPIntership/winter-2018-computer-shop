@extends('admin.layout.master')
@section('content')
<!-- Page Header-->
@include('admin.partials.header', ['title' => "Users Management"])
<!-- Forms Section-->
<section class="forms"> 
            <div class="container-fluid">
              <div class="row">
                <!-- Basic Form-->
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">@lang('master.content.action.add', ['attribute' => 'User'])</h3>
                    </div>
                    <div class="card-body">
                      <form>
                        <div class="form-group">
                          <label class="form-control-label">@lang('master.content.table.email')<span class="star">*<span></label>
                          <input type="email" placeholder="Email Address" class="form-control">
                        </div>
                        <div class="form-group">       
                          <label class="form-control-label">@lang('master.content.form.password')</label>
                          <input type="password" placeholder="Password" class="form-control">
                        </div>
                        <div class="form-group">       
                          <label class="form-control-label">@lang('master.content.form.name')</label>
                          <input type="password" placeholder="Password" class="form-control">
                          <!-- <div class="invalid-feedback">Please provide your name.</div> -->
                        </div>
                        <div class="form-group">       
                          <label class="form-control-label">@lang('master.content.form.address')</label>
                          <input type="password" placeholder="Password" class="form-control">
                          <!-- <div class="invalid-feedback">Please provide your name.</div> -->
                        </div>
                        <div class="form-group">       
                          <label class="form-control-label">@lang('master.content.form.phone')</label>
                          <input type="password" placeholder="Password" class="form-control">
                          <!-- <div class="invalid-feedback">Please provide your name.</div> -->
                        </div>
                        <div class="form-group row">
                          <label class="form-control-label col-sm-12">@lang('master.content.table.role')</label>
                          <div class="col-sm-12">
                            <select name="account" class="form-control mb-3">
                              <option>option 1</option>
                              <option>option 2</option>
                              <option>option 3</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="fileInput" class="col-sm-3 form-control-label">@lang('master.content.form.avatar')</label>
                          <div class="col-sm-9">
                            <input id="fileInput" type="file" class="form-control-file">
                          </div>
                        </div>
                        <div class="form-group">       
                          <input type="submit" value="Create" class="btn btn-primary">
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                </div>
                </div>
</section>
@endsection
