 @extends('admin.layout.master')
 @section('content')
<!-- Page Header-->
<header class="page-header">
  <div class="container-fluid">
    <h2 class="no-margin-bottom">{{ __('master.content.dashboard.title') }}</h2>
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
          <div class="title"><span>{{ __('master.content.dashboard.user')}}<br>{{ __('master.content.dashboard.totals')}}</span>
          </div>
          <div class="number"><strong>{{ $arrayData['totalUser'] }}</strong></div>
        </div>
      </div>
      <!-- Item -->
      <div class="col-xl-4 col-sm-6">
        <div class="item d-flex align-items-center">
          <div class="icon bg-red"><i class="icon-padnote"></i></div>
          <div class="title"><span>{{ __('master.content.dashboard.order')}}<br>{{ __('master.content.dashboard.totals')}}</span>
            
          </div>
          <div class="number"><strong>{{ $arrayData['totalOrder'] }}</strong></div>
        </div>
      </div>
      <!-- Item -->
      <div class="col-xl-4 col-sm-6">
        <div class="item d-flex align-items-center">
          <div class="icon bg-green"><i class="icon-bill"></i></div>
          <div class="title"><span>{{ __('master.content.dashboard.product')}}<br>{{ __('master.content.dashboard.totals')}}</span>
            
          </div>
          <div class="number"><strong>{{ $arrayData['totalProduct'] }}</strong></div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Dashboard Header Section    -->
<section class="dashboard-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-5">
        <h1 class="text-center mb-4">{{ __('master.content.dashboard.statistic_order') }}</h1>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">{{ __('master.content.table.id') }}</th>
              <th scope="col">{{ __('master.content.dashboard.cancel') }}</th>
              <th scope="col">{{ __('master.content.dashboard.approve') }}</th>
              <th scope="col">{{ __('master.content.dashboard.pending') }}</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">{{ __('master.content.dashboard.totals') }}</th> 
              <td>{{ $arrayData['cancelOrder'] }}</td>
              <td>{{ $arrayData['approveOrder'] }}</td>
              <td>{{ $arrayData['pendingOrder'] }}</td>
            </tr>
          </tbody>
        </table>
        <div align="center">
          <a href="{{ route('admin.excel') }}" class="btn btn-success">{{ __('master.content.dashboard.export') }}</a>
         </div>
      </div> 
        
      <div class="col-7 item d-flex align-items-center">
        <canvas id="mycanvas" class="w-100 h-200"></canvas>
      </div>
    </div>
  </div>
    
</section>
<script type="text/javascript">
    var cancelOrder = <?php echo json_decode($arrayData['cancelOrder']); ?>;
    var pendingOrder = <?php echo json_decode($arrayData['pendingOrder']); ?>;
    var approveOrder = <?php echo json_decode($arrayData['approveOrder']); ?>;
    // console.log(cancelOrder, pendingOrder, approveOrder);
</script>
@endsection
