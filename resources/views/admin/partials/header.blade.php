<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">{{$title}}</h2>
    </div>
</header>
<!-- Breadcrumb-->
<div class="breadcrumb-holder container-fluid">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">@lang('master.sidebar.home')</a></li>
        <li class="breadcrumb-item active">{{$title}}</li>
    </ul>
</div>
