@extends('public.layout.master')
@section('content')
@include('public.partials.breadcrumb', ['attribute' => trans('public.header.login')])
<!-- Login Section Start -->
<div class="login-section section mt-90 mb-90">
    <div class="container">
        <div class="row">
            
            <!-- Login -->
            <div class="col-md-6 col-12 d-flex">
                <div class="ee-login">
                    @include('admin.partials.message')
                    @include('admin.partials.warning')
                    <h3>@lang('public.login.title')</h3>
                    
                    <!-- Login Form -->
                    <form action="{{route('public.login')}}" method="POST">
                    @csrf
                        <div class="row">
                            <div class="col-12 mb-30"><input name='email' type="text" placeholder="@lang('public.login.email')" value="{{old('name')}}">
                            @include('admin.partials.error', ['err' => 'email'])
                            </div>
                            <div class="col-12 mb-20"><input name='password' type="password" placeholder="@lang('public.login.password')">
                            @include('admin.partials.error', ['err' => 'password'])
                            </div>
                            <div class="col-12"><input type="submit" value="@lang('public.header.login')"></div>
                        </div>
                    </form>
                    <h4>@lang('public.login.click') <a href="{{route('public.register')}}">@lang('public.header.register')</a></h4>
                </div>
            </div>
            
            <div class="col-md-1 col-12 d-flex">
                
                <div class="login-reg-vertical-boder"></div>
                
            </div>
            
            <!-- Login With Social -->
            <div class="col-md-5 col-12 d-flex">
                
                <div class="ee-social-login">
                    <h3>@lang('public.login.with')</h3>
                    
                    <a href="#" class="facebook-login">@lang('public.login.social') <i class="fa fa-facebook"></i></a>
                    <a href="#" class="twitter-login">@lang('public.login.social') <i class="fa fa-twitter"></i></a>
                    <a href="#" class="google-plus-login">@lang('public.login.social') <i class="fa fa-google-plus"></i></a>
                    
                </div>
                
            </div>
            
        </div>
    </div>
</div><!-- Login Section End -->
@endsection
