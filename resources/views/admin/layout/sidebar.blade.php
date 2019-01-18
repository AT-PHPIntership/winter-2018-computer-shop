<!-- Side Navbar -->
<nav class="side-navbar">
  <!-- Sidebar Header-->
  <div class="sidebar-header d-flex align-items-center">
    <div class="avatar"><img src="admin_asset/img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
    <div class="title">
      <h1 class="h4">Mark Stephen</h1>
    </div>
  </div>
  <!-- Sidebar Navidation Menus-->
  <ul class="list-unstyled">
    <li><a href="{{route('admin.home')}}"><i class="fa fa-home"></i>@lang('master.sidebar.home')</a></li>
    <li><a href="{{route('users.index')}}"><i class="fa fa-users"></i>@lang('master.sidebar.user')</a></li>
    <li><a href="{{route('roles.index')}}"><i class="fa fa-universal-access"></i>@lang('master.sidebar.role')</a></li>
    <li><a href="{{route('categories.index')}}"> <i class="fa fa-align-justify"></i>@lang('master.sidebar.category')</a></li>
    <li><a href="{{route('products.index')}}"> <i class="fa fa-industry"></i>@lang('master.sidebar.product')</a></li>
    <li><a href="{{route('slides.index')}}"> <i class="fa fa-image"></i>@lang('master.sidebar.slide')</a></li>
    <li><a href="login.html"><i class="fa fa-comments"></i>@lang('master.sidebar.comment')</a></li>
    <li><a href="login.html"><i class="fa fa-shopping-cart"></i>@lang('master.sidebar.order')</a></li>
    <li><a href="{{ route('promotions.index') }}"><i class="fa fa-snowflake-o"></i>@lang('master.sidebar.promotion')</a></li>
    <li><a href="{{ route('codes.index') }}"><i class="fa fa-money"></i>@lang('master.sidebar.code')</a></li>
  </ul>
</nav>
