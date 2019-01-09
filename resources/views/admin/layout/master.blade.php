<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@lang('master.title')</title>
    <base href="{{asset('')}}">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="admin_asset/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="admin_asset/vendor/font-awesome/css/font-awesome.min.css">
    <!-- datatable stylesheet-->
    <link rel="stylesheet" href="admin_asset/vendor/datatable/datatables.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="admin_asset/css/fontastic.css">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="admin_asset/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="admin_asset/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="admin_asset/img/favicon.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="page">
      @include('admin.layout.header')
      <div class="page-content d-flex align-items-stretch"> 
        @include('admin.layout.sidebar')
        <div class="content-inner">
        @yield('content')
        @include('admin.layout.footer')
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="admin_asset/vendor/jquery/jquery.min.js"></script>
    <script src="admin_asset/vendor/datatable/datatables.min.js"> </script>
    <script src="admin_asset/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="admin_asset/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="admin_asset/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="admin_asset/vendor/chart.js/Chart.min.js"></script>
       <!-- Main File-->
    <script src="admin_asset/js/front.js"></script>
     <!----Custom file--->
     <script src="admin_asset/js/custom.js"></script>
  </body>
</html>
