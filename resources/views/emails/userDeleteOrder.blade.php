<!DOCTYPE html>
<html>

<body>
    <p>The user with name: {{$user["name"]}} has email: {{$user["email"]}}</p>
    <p>His order with id: {{$user["order"]}}</p>
    <table style='text-align:center;border: 1px solid black;'>
        <tr>
            <th style='border: 1px solid black;'>Product Name</th>
            <th style='border: 1px solid black;'>Price</th>
            <th style='border: 1px solid black;'>Quantity</th>
            <th style='border: 1px solid black;'>Total</th>
        </tr>
        @foreach($data as $order)
        <tr>
            <td style='border: 1px solid black;'>{{$order->product->name}}</td>
            <td style='border: 1px solid black;'>{!!number_format($order["price"],0,",",".") . ' đ'!!}</td>
            <td style='border: 1px solid black;'>{{$order["quantity"]}}</td>
            <td style='border: 1px solid black;'>{!!number_format($order["price"]*$order["quantity"],0,",",".") . ' đ'!!}</td>
        </tr>
        @endforeach
    </table>
    <p>This order was deleted.</p>
    <p>Thanks</p>
</body>

</html> 