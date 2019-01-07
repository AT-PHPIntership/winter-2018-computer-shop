@extends('admin.layout.master')
@section('content')
<div class="page-header">
    <h1>Order Manager</h1>
<br>
    @if(session('notification'))
    <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
    </button>
        {{session('notification')}}
    </div>
    @endif
    
    <div class="hr hr-18 dotted hr-double"></div>

    <!-- <div class="row"> -->
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">
                <div class="col-xs-12">
                    <table id="simple-table" class="table  table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center">ID</th>
                                <th class="detail-col">Details</th>
                                <th class="center">User</th>
                                <th class="center">Address</th>
                                <th class="center">Phone</th>
                                <th class="center">Note</th>
                                <th class="center">Date order</th>
                                <th class="center">Status</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td  class="center">{{ $order->id }}</td>
                                <td class="center">
                                    <div class="action-buttons">
                                        <a href="" class="green bigger-140 show-details-btn" title="Show Details" id="{{ $order->id }}">
                                            <i class="ace-icon fa fa-angle-double-down"></i>
                                            <span class="sr-only">Details</span>
                                        </a>
                                    </div>
                                </td>
                                <td  class="center">
                                    name
                                </td>
                                <td  class="center">{{ $order->address }}</td>
                                <td  class="center">{{ $order->phone }}</td>
                                <td  class="center">{{$order->note}}</td>

                                <td  class="center">
                                    <span class="btn btn-white btn-primary">{{$order->date_order }}</span>
                                </td>

                                <td class="center">
                                    <div class="hidden-sm hidden-xs btn-group ">
                                        <a class="green" href="admin/order/edit/{{$order->id}}">
                                            <i class="ace-icon fa fa-pencil bigger-130" style='position:relative; right: 10px'></i>
                                        </button>
                                        </a>
                                        <a class='red' data-orderid='{{ $order->id }}' data-toggle="modal" data-target="#delete" title="Delete order">
                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                        </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @foreach($order->orderDetails as $orderDetail)
                                <tr class="detail-row order-detail-{{$order->id}}" >
                                <td colspan="8">
                                    <div class="table-detail">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-2">
                                                <div class="text-center">
                                                    <img height="150" class="thumbnail inline no-margin-bottom" alt="Domain Owner's Avatar" src=""
                                                    width='176.83 px'/>
                                                    <br />
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-7">

                                                <div class="profile-user-info profile-user-info-striped">
                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Product Name </div>

                                                        <div class="profile-info-value">
                                                            <span>{{$orderDetail->product->name}}</span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Price </div>

                                                        <div class="profile-info-value">
                                                            <span>{{$orderDetail->price}}</span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name">Quantity</div>

                                                        <div class="profile-info-value">
                                                            <span>{{$orderDetail->quantity}}</span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- /.span -->
            </div><!-- /.row -->
        </div><!-- /.col -->
    <!-- Modal -->
    <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style='position: relative; top:21px; font-weight:bold;'>Delete Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="GET" id='delete-order'>
                        {{csrf_field()}}
                    <div class="modal-body">
                    <p class="text-center" style='color: red;'>
                        Are you sure want to delete this order?
                    </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    jQuery(function($) {
        $('.show-details-btn').on('click', function(e) {
            e.preventDefault();
            var order_id= $(this).attr('id');
            // console.log(order_id,$('.detail-row').length );

            $('.detail-row').each(function( index ) {
                $(this).removeClass('open');
            });
            $('.order-detail-'+order_id).each(function( index ) {
                $(this).addClass('open');
            });
            $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
        });
    })
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script>
    $('#delete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var orderID = button.data('orderid')
            $("#delete-order").attr('action', 'admin/order/delete/' + orderID );

    })
</script>
@endsection
