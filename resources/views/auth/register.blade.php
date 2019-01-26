@extends('public.layout.master')
@section('content')
@include('public.partials.breadcrumb', ['attribute' => trans('public.header.register')])
<!-- Register Section Start -->
<div class="register-section section mt-90 mb-90">
    <div class="container">
        <div class="col-md-6">
            @include('admin.partials.warning')
        </div>
        <div class="row">

            <div class="col-md-2 col-12 d-flex">
                
                <div class="login-reg-vertical-boder"></div>
                
            </div>
            
            <!-- Register -->
            <div class="col-md-8 col-12 d-flex">
                <div class="ee-register">
                    
                    <!-- Register Form -->
                    <form action="{{route('public.register')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="row">
                            <h1>@lang('public.header.register')</h1>
                            @if( !empty($errors->has('role_id')) || !empty($errors->has('is_actived')))
                            <div class="alert alert-warning col-12 mb-30">
                                <div>
                                    @include('admin.partials.error', ['err' => 'role_id'])
                                </div>
                                <div>
                                    @include('admin.partials.error', ['err' => 'is_actived'])
                                </div>
                            </div>
                            @endif
                            <div class="col-12 mb-30"><input name="name" type="text" placeholder="@lang('public.register.name')" value="{{old('name')}}">
                            @include('admin.partials.error', ['err' => 'name'])
                            </div>
                            <div class="col-12 mb-30"><input name="email" type="email" placeholder="@lang('public.register.email')" value="{{old('email')}}">
                            @include('admin.partials.error', ['err' => 'email'])
                            </div>
                            <div class="col-12 mb-30"><input name="password" type="password" placeholder="@lang('public.register.password')">
                            @include('admin.partials.error', ['err' => 'password'])
                            </div>
                            <div class="col-12 mb-30"><input name="password_confirmation" type="password" placeholder="@lang('public.register.confirm')"></div>
                            <input type="hidden" name="role_id" value="1">
                            <input type="hidden" name="is_actived" value="0">
                            <div class="col-12"><input type="submit" value="@lang('public.header.register')"></div>
                        </div>
                    </form>

                </div>
            </div>
            
            <div class="col-md-2 col-12 d-flex">
                
                <div class="login-reg-vertical-boder"></div>
                
            </div>
        
        </div>
    </div>
</div><!-- Register Section End -->
@endsection