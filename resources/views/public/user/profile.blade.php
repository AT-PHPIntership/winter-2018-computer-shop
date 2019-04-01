@extends('public.layout.master') @section('content')
@include('public.partials.breadcrumb', ['attribute' =>
trans('public.profile.title')]) <div class="page-wrap"> <div
class="ps-section--hero"><img src="frontend/images/hero/01.jpg"
alt=""> <div class="container"> <div class="row"> <div
class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "> <div
class="ps-blog-detail pt-80 pb-80"> <div class="ps-post">
@include('admin.partials.message') @include('admin.partials.warning')
<ul class="single-product-tab-list nav"> <li><a href="#user_profile"
class="active"
data-toggle="tab">@lang('public.profile.list.profile')</a></li> <li><a
href="#user_password" data-toggle="tab"
class='user_password'>@lang('public.profile.list.password')</a></li>
<li><a href="#user_code" data-toggle="tab"
class='user_order'>@lang('public.profile.list.code')</a></li> <li><a
href="#user_order" data-toggle="tab"
class='user_order'>@lang('public.profile.list.order')</a></li> </ul>
<div class="single-product-tab-content tab-content"> <div
class="tab-pane fade show active" id="user_profile"> <div class="row">
<div class="single-product-description-content col-lg-8 col-12"> <form
class="form-horizontal" method="POST"
action="{{route('user.update.profile', Auth::user()->id)}}"
enctype="multipart/form-data"> @method('PUT') @csrf <div
class="tabbable">

                                                    <div class="tab-content profile-edit-tab-content">
                                                        <div id="edit-basic" class="tab-pane in active">

                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label no-padding-right">@lang('master.content.form.name')</label>

                                                                <div class="col-sm-9">
                                                                    <span class="input-icon input-icon-right">
                                                                        <input type="text" value="{{Auth::user()->name}}" name='name' required>
                                                                    </span>
                                                                </div>
                                                                @include('admin.partials.error', ['err' => trans('master.content.attribute.name')])
                                                            </div>

                                                            <div class="space-4"></div>

                                                            <div class="form-group">

                                                                <label class="col-sm-3 control-label no-padding-right">@lang('master.content.table.email')</label>

                                                                <div class="col-sm-9">
                                                                    <span class="input-icon input-icon-right">
                                                                        <input type="email" value="{{Auth::user()->email}}" name='email' required>
                                                                        <i class="ace-icon fa fa-envelope"></i>
                                                                    </span>
                                                                </div>
                                                                @include('admin.partials.error', ['err' => trans('master.content.attribute.email')])
                                                            </div>

                                                            <div class="space-4"></div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-website">@lang('master.content.form.address')</label>
                                                                @if(isset(Auth::user()->profile->address))
                                                                <div class="col-sm-9">
                                                                    <span class="input-icon input-icon-right">
                                                                        <input type="text" value="{{!(Auth::user()->profile->address) ? old('address') : Auth::user()->profile->address}}" name='address'>
                                                                        <i class="ace-icon fa fa-home"></i>
                                                                    </span>
                                                                </div>
                                                                @include('admin.partials.error', ['err' => trans('master.content.attribute.address')])
                                                                @else
                                                                <div class="col-sm-9">
                                                                    <span class="input-icon input-icon-right">
                                                                        <input type="text" value="{{old('address')}}" name='address'>
                                                                        <i class="ace-icon fa fa-home"></i>
                                                                    </span>
                                                                </div>
                                                                @include('admin.partials.error', ['err' => trans('master.content.attribute.address')])
                                                                @endif
                                                            </div>

                                                            <div class="space-4"></div>

                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-phone">@lang('master.content.form.phone')</label>
                                                                @if(isset(Auth::user()->profile->address))
                                                                <div class="col-sm-9">
                                                                    <span class="input-icon input-icon-right">
                                                                        <input class="input-medium input-mask-phone" type="number" id="form-field-phone" value="{{!(Auth::user()->profile->phone) ? old('phone') : Auth::user()->profile->phone}}" name='phone'>
                                                                        <i class="ace-icon fa fa-phone fa-flip-horizontal"></i>
                                                                    </span>
                                                                </div>
                                                                @include('admin.partials.error', ['err' => trans('master.content.attribute.phone')])
                                                                @else
                                                                <div class="col-sm-9">
                                                                    <span class="input-icon input-icon-right">
                                                                        <input class="input-medium input-mask-phone" type="number" id="form-field-phone" value="{{old('phone')}}" name='phone'>
                                                                        <i class="ace-icon fa fa-phone fa-flip-horizontal"></i>
                                                                    </span>
                                                                </div>
                                                                @include('admin.partials.error', ['err' => trans('master.content.attribute.phone')])
                                                                @endif
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-phone">@lang('master.content.form.avatar')</label>
                                                                @if(isset(Auth::user()->profile->avatar))
                                                                <div class="col-sm-2">
                                                                    <img src='{{ (is_numeric(Auth::user()->profile->avatar[0])) ? 'storage/avatar/' .Auth::user()->profile->avatar : Auth::user()->profile->avatar }}' alt="" class="img">
                                                                </div>
                                                                @else
                                                                <div class="col-sm-8">
                                                                    <p class="mt-4 text-danger">{{Auth::user()->name}} @lang('master.content.message.img', ['attribute' => trans('master.content.attribute.image')])</p>
                                                                </div>
                                                                @endif
                                                                <div class="col-sm-8">
                                                                    <input type="file" id="fileInput" name="avatar" class="form-control-file mt-1">
                                                                </div>
                                                                @include('admin.partials.error', ['err' => trans('master.content.attribute.avatar')])
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @include('public.partials.submit')
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="user_password">
                                    <div class="row">
                                        <div class="single-product-description-content col-lg-12 col-12">
                                            <form class="password-form" method="POST" action="{{route('user.update.password', Auth::user()->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="tabbable">
                                                    <div class="form-group">
                                                        @if (Auth::user()->password != "")
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-facebook">@lang('master.content.form.current_pw')</label>

                                                        <div class="col-sm-9">
                                                            <span class="input-icon">
                                                                <input type="password" value="" name='current_password' required>
                                                                <i class="ace-icon fa  fa-key"></i>
                                                            </span>
                                                        </div>
                                                        @endif
                                                        @include('admin.partials.error', ['err' => trans('master.content.attribute.current')])
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-facebook">@lang('master.content.form.new_pw')</label>

                                                        <div class="col-sm-9">
                                                            <span class="input-icon">
                                                                <input type="password" value="" name='password' required>
                                                                <i class="ace-icon fa  fa-key"></i>
                                                            </span>
                                                        </div>
                                                        @include('admin.partials.error', ['err' => trans('master.content.attribute.password')])
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-twitter">@lang('master.content.form.confirm_pw')</label>

                                                        <div class="col-sm-9">
                                                            <span class="input-icon">
                                                                <input type="password" value="" name='password_confirmation' required>
                                                                <i class="ace-icon fa fa-key "></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @include('public.partials.submit')
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="user_code">
                                    <div class="row">
                                        <div class="single-product-description-content col-lg-12 col-12">
                                            <table id="simple-table" class="table table-bordered table-hover text-center">
                                                <thead>
                                                    <tr>
                                                        <th class="center">@lang('master.content.table.id')</th>
                                                        <th class="center">@lang('master.content.form.name')</th>
                                                        <th class="center">@lang('master.content.table.start_at')</th>
                                                        <th class="center">@lang('master.content.table.end_at')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (Auth::user()->codes as $key => $code)
                                                    <tr>
                                                        <td class="center">{{$code->id}}</td>
                                                        <td class="center">{{$code->name}}</td>
                                                        <td class="center">{{$code->start_at}}</td>
                                                        <td class="center">{{$code->end_at}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="user_order">
                                    <div class="row">
                                        <div class="single-product-description-content col-lg-12 col-12">
                                            <table id="simple-table" class="table table-bordered table-hover text-center">
                                                <thead>
                                                    <tr>
                                                        <th class="center">@lang('master.content.table.id')</th>
                                                        <th class="center">@lang('master.content.form.address')</th>
                                                        <th class="center">@lang('master.content.form.phone')</th>
                                                        <th class="center">@lang('master.content.table.order_date')</th>
                                                        <th class="center">@lang('master.content.table.note')</th>
                                                        <th class="center">@lang('master.content.table.status')</th>
                                                        <th class="center">@lang('master.content.table.action')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (Auth::user()->orders as $key => $order)
                                                    <tr>
                                                        <td class="center"><a data-toggle="collapse" data-target="#collapse-{{$key}}" aria-expanded="false" aria-controls="collapseExample">
                                                                <i class="ace-icon fa fa-plus-circle"></i></a></td>
                                                        <td class="center">{{$order->address}}</td>
                                                        <td class="center">{{$order->phone}}</td>
                                                        <td class="center">{{$order->date_order}}</td>
                                                        <td class="center">{{$order->note}}</td>
                                                        <td><span class="btn btn-white btn-success">{{$order->getCurrentStatusAttribute()}}</span></td>
                                                        <td>
                                                            <div class="hidden-sm hidden-xlg btn-group">
                                                                <form action="{{route('user.delete.order', $order->id)}}" method='POST' onsubmit="return confirmedDelete()">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-danger">
                                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="detail-row order-detail collapse" id="collapse-{{$key}}">
                                                        <td colspan="12">
                                                            @foreach ($order->orderDetails as $detail)
                                                            <div class="table-detail">
                                                                <div class="row table table-bordered">
                                                                    <div class="col-xs-12 col-sm-2 mr-5">
                                                                        <div class="text-center">
                                                                            <img class="thumbnail inline no-margin-bottom" alt="" src="storage/product/{{$detail->product->images->first()->name}}" width='176.83' />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-7 ml-5">
                                                                        <div class="profile-user-info profile-user-info-striped">
                                                                            <div class="profile-info-row ">
                                                                                <div class="profile-info-name">@lang('master.content.table.productName'): <span>{{$detail->product->name}}</span> </div>

                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name">@lang('master.content.form.price'): <span>{!!number_format($detail->price,0,",",".") . ' vnđ'!!}</span> </div>
                                                                                </div>

                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name">@lang('master.content.form.quantity'): <span>{{$detail->quantity}}</span>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endsection 