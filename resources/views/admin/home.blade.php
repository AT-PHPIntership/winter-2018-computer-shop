 @extends('admin.layout.master')
 @section('content')
<!-- Page Header-->
<header class="page-header">
  <div class="container-fluid">
    <h2 class="no-margin-bottom">Dashboard</h2>
  </div>
</header>
<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom">
  <div class="container-fluid">
    <div class="row bg-white has-shadow">
      <!-- Item -->
      <div class="col-xl-4 col-sm-6">
        <div class="item d-flex align-items-center">
          <div class="icon bg-violet"><i class="icon-user"></i></div>
          <div class="title"><span>Totals<br>User</span>
            
          </div>
          <div class="number"><strong>25</strong></div>
        </div>
      </div>
      <!-- Item -->
      <div class="col-xl-4 col-sm-6">
        <div class="item d-flex align-items-center">
          <div class="icon bg-red"><i class="icon-padnote"></i></div>
          <div class="title"><span>Totals<br>Order</span>
            
          </div>
          <div class="number"><strong>70</strong></div>
        </div>
      </div>
      <!-- Item -->
      <div class="col-xl-4 col-sm-6">
        <div class="item d-flex align-items-center">
          <div class="icon bg-green"><i class="icon-bill"></i></div>
          <div class="title"><span>Totals<br>Product</span>
            
          </div>
          <div class="number"><strong>40</strong></div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Dashboard Header Section    -->
<section class="dashboard-header">
  <div class="container-fluid">
    <div class="row">
      <!-- Statistics -->
      <div class="statistics col-lg-3 col-12">
        
      </div>
      <!-- Line Chart            -->
      <div class="chart col-lg-6 col-12">
        <div class="line-chart bg-white d-flex align-items-center justify-content-center has-shadow">
          <canvas id="lineCahrt"></canvas>
        </div>
      </div>
      <div class="chart col-lg-3 col-12">
        
      </div>
    </div>
  </div>
</section>
@endsection
