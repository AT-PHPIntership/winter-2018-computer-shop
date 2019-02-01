<!-- Header Section Start -->
<div class="header-section section">
    <!-- Header Top Start -->
    <div class="header-top header-top-one header-top-border pt-10 pb-10">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col mt-10 mb-10">
                    <!-- Header Links Start -->
                    <div class="header-links">
                       <a href="/">
                            <img src="public_asset/images/logo.png" alt="">
                            <img class="theme-dark" src="public_asset/images/logo-light.png" alt="">
                        </a>
                    </div><!-- Header Links End -->
                </div>
                <div class="col order-12 order-xs-12 order-lg-2 mt-10 mb-10">
                    <!-- Header Advance Search Start -->
                    <div class="header-advance-search">
                        <form action="#">
                            <div class="input"><input type="text" placeholder="@lang('public.header.search')"></div>
                            <div class="submit"><button><i class="icofont icofont-search-alt-1"></i></button></div>
                        </form>
                    </div><!-- Header Advance Search End -->
                </div>
                <div class="col order-2 order-xs-2 order-lg-12 mt-10 mb-10">
                    <!-- Header Account Links Start -->
                    <div class="header-account-links">
                        <a href="register.html"><i class="icofont icofont-user-alt-7"></i> <span>@lang('public.header.account')</span></a>
                        <a href="{{route('public.login')}}"><i class="icofont icofont-login d-none"></i> <span>@lang('public.header.login')</span></a>
                        <a href="{{route('public.register')}}"><i class="icofont icofont-login d-none"></i> <span>@lang('public.header.register')</span></a>
                    </div><!-- Header Account Links End -->
                </div>
            </div>
        </div>
    </div><!-- Header Top End -->
    <!-- Header Bottom Start -->
    <div class="header-bottom header-bottom-one header-sticky">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col mt-15 mb-15">            
                </div>
                <div class="col order-12 order-lg-2 order-xl-2 d-none d-lg-block">
                    <!-- Main Menu Start -->
                    <div class="main-menu">
                        <nav>
                            <ul>
                                <li class="active"><a href="/">@lang('public.header.home')</a></li>
                                <li class="menu-item-has-children"><a href="{{route('public.allCategory')}}">@lang('public.header.category')</a>
                                    <ul class="sub-menu">
                                        @foreach($categories as $category)
                                        <li class="menu-item-has-children"><a href="{{route('public.category', $category->id)}}"><img class="img-thumbnail" src="storage/category/{{$category->image}}" width="120" height="60"></a>
                                            <ul class="sub-menu">
                                                @foreach ($category->childrens->pluck('name', 'id') as $key => $val)
                                                <li>
                                                    <a href="{{route('public.category', $key)}}">
                                                        {{$val}}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="{{ route('public.cart') }}">@lang('public.header.cart')</a></li>
                                <li><a href="contact.html">@lang('public.header.contact')</a></li>
                            </ul>
                        </nav>
                    </div><!-- Main Menu End -->
                </div>
                <div class="col order-2 order-lg-12 order-xl-12">
                    <!-- Header Shop Links Start -->
                    <div class="header-shop-links">
                        <!-- Compare -->
                        <a href="" id="header-compare"><i class="ti-control-shuffle"></i></a>
                        <!-- Cart -->
                        <a href="cart.html" class="header-cart"><i class="ti-shopping-cart"></i> <span class="number">0</span></a> 
                    </div><!-- Header Shop Links End -->
                </div>
                <!-- Mobile Menu -->
                <div class="mobile-menu order-12 d-block d-lg-none col"></div>
            </div>
        </div>
    </div><!-- Header Bottom End -->
</div><!-- Header Section End -->