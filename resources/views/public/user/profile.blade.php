@extends('public.layout.master')
@section('content')
<div class="page-wrap">

<div class="ps-section--hero"><img src="frontend/images/hero/01.jpg" alt="">
            <div class="ps-section__content text-center">
                <h3 class="ps-section__title">OUR BAKERY</h3>
                <div class="ps-breadcrumb">
                    <ol class="breadcrumb">
                        <li><a href="homepage">Home</a></li>
                        <li class="active">My Profile</li>
                    </ol>
                </div>
            </div>
        </div>
<div class="ps-section--page-reverse">
        <div class="container">
          <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
                  <div class="ps-blog-detail pt-80 pb-80">
                    <div class="ps-post">
                    @if(session('notification'))
                    <div class="alert alert-success" data-dismiss="alert">
                        {!!session('notification')!!}
                    </div>
                     @endif
                      <div class="ps-post__header"><a class="ps-post__title" >My Profile</a>
                      </div>
                      <div class="ps-post__content">
                        <div class="">
                            <div id="user-profile-3" class="user-profile row">
                                <div class="col-sm-offset-1 col-sm-10">
                                        <div class="well well-sm hide">

                                        </div><!-- /.well -->

                                        <div class ="space"></div>

                                    <form class="form-horizontal" method="POST" action='user/profile/change/{{Auth::user()->id}}'>
                                        {{ csrf_field() }}
                                        <div class="tabbable">

                                            <div class="tab-content profile-edit-tab-content">
                                                <div id="edit-basic" class="tab-pane in active">

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-email">Name</label>

                                                        <div class="col-sm-9">
                                                            <span class="input-icon input-icon-right">
                                                                <input type="text" id="form-field-email" value="{{Auth::user()->name}}" name='name'/>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="space-4"></div>

                                                    <div class="form-group">

                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-email">Email</label>

                                                        <div class="col-sm-9">
                                                            <span class="input-icon input-icon-right">
                                                                <input type="email" id="form-field-email" value="{{Auth::user()->email}}" name='email'/>
                                                                <i class="ace-icon fa fa-envelope"></i>
                                                                @if ($errors->has('email'))
                                                                    <span class="help-block">
                                                                        <strong style='color:red'>{{ $errors->first('email') }}
                                                                        </strong>
                                                                    </span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="space-4"></div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-website">Address</label>

                                                        <div class="col-sm-9">
                                                            <span class="input-icon input-icon-right">
                                                                <input type="text" id="form-field-website" value="{{Auth::user()->address}}" name='address'/>
                                                                <i class="ace-icon fa fa-home"></i>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="space-4"></div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-phone">Phone</label>

                                                        <div class="col-sm-9">
                                                            <span class="input-icon input-icon-right">
                                                                <input class="input-medium input-mask-phone" type="number" id="form-field-phone" value="{{Auth::user()->phone}}" name='phone'/>
                                                                <i class="ace-icon fa fa-phone fa-flip-horizontal"></i>
                                                                @if ($errors->has('phone'))
                                                                    <span class="help-block">
                                                                        <strong style='color:red'>{{ $errors->first('phone') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-phone"></label>

                                                        <div class="col-sm-9">
                                                            <span class="input-icon input-icon-right">
                                                            <input type="checkbox" onclick="myFunction()" id='showEnterPassword' name='changepassword' {{ old('changepassword') ? 'checked':'' }}> Change password<br>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="space"></div>

                                                    <div id='formPassword' style='display:none'>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-facebook">Password</label>

                                                            <div class="col-sm-9">
                                                                <span class="input-icon">
                                                                    <input type="password" id="form-field-facebook" value="" name='password'/>
                                                                    <i class="ace-icon fa  fa-key"></i>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="space-4"></div>

                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-twitter">Confirm Password</label>

                                                            <div class="col-sm-9">
                                                                <span class="input-icon">
                                                                    <input type="password" value="" id="form-field-twitter" name='confirm_password'/>
                                                                    <i class="ace-icon fa fa-key "></i>
                                                                    @if ($errors->has('confirm_password'))
                                                                        <span class="help-block">
                                                                            <strong style='color:red'>{{ $errors->first('confirm_password') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="clearfix form-actions">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button class="btn btn-info" type="submit">
                                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                                    Save
                                                </button>

                                                &nbsp; &nbsp;
                                                <button class="btn" type="reset">
                                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                                    Reset
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                  <div class="ps-sidebar">
                    <aside class="ps-widget ps-widget--sidebar ps-widget--category">
                      <div class="ps-widget__header">
                        <h3 class="ps-widget__title">My Area</h3>
                      </div>
                      <div class="ps-widget__content">
                        <ul class="ps-list--arrow">
                          <li class="current"><a href="user/profile"><span class="circle"></span>My Profile</a></li>
                          <li><a href="user/order"><span class="circle"></span>My Order</a></li>
                        </ul>
                      </div>
                    </aside>
                  </div>
                </div>
          </div>
        </div>
      </div>
</div>
@endsection
