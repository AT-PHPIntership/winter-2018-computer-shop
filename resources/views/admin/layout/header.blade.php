<header class="header">
  <nav class="navbar">
    <div class="container-fluid">
      <div class="navbar-holder d-flex align-items-center justify-content-between">
        <!-- Navbar Header-->
        <div class="navbar-header">
          <!-- Navbar Brand -->
          <a href="{{route('admin.home')}}" class="navbar-brand d-none d-sm-inline-block">
          <div class="brand-text d-none d-lg-inline-block"><span>@lang('master.header.title')</span>&nbsp;<strong>@lang('master.header.admin')</strong></div>
            <!-- <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>BD</strong></div></a> -->
          <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
        </div>
        <!-- Navbar Menu -->
        <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
          <!-- Messages                        -->
          <li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-envelope-o"></i><span class="badge bg-orange badge-corner">10</span></a>
            <ul aria-labelledby="notifications" class="dropdown-menu">
              <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                  <div class="msg-profile"> <img src="admin_asset/img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
                  <div class="msg-body">
                    <h3 class="h5">Jason Doe</h3><span>Sent You Message</span>
                  </div></a></li>
              <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                  <div class="msg-profile"> <img src="admin_asset/img/avatar-2.jpg" alt="..." class="img-fluid rounded-circle"></div>
                  <div class="msg-body">
                    <h3 class="h5">Frank Williams</h3><span>Sent You Message</span>
                  </div></a></li>
              <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                  <div class="msg-profile"> <img src="admin_asset/img/avatar-3.jpg" alt="..." class="img-fluid rounded-circle"></div>
                  <div class="msg-body">
                    <h3 class="h5">Ashley Wood</h3><span>Sent You Message</span>
                  </div></a></li>
              <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>Read all messages   </strong></a></li>
            </ul>
          </li>
          <!-- Logout    -->
          <li class="nav-item"><a href="{{ route('logout') }}"  class="nav-link logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>

           <span class="d-none d-sm-inline">@lang('master.header.logout')</span><i class="fa fa-sign-out"></i></a></li>
        </ul>
      </div>
    </div>
  </nav>
</header>
