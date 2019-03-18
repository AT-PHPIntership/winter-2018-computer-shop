<!DOCTYPE html>
<html>
<link rel="stylesheet" href="admin_asset/css/custom.css">

<body>
    <table>
        <thead>
            <tr>
                <th class="export">@lang('master.content.table.id')</th>
                <th class="export">@lang('master.content.table.user_name')</th>
                <th class="export">@lang('master.content.table.address')</th>
                <th class="export">@lang('master.content.table.phone')</th>
                <th class="export">@lang('master.content.table.note')</th>
                <th class="export">@lang('master.content.table.date_order')</th>
                <th class="export">@lang('master.content.table.status')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $order)
            <tr>
                <th class="export">{{ $order->id }}</th>
                <td class="export">{{ $order->user->name }}</td>
                <td class="export">{{ $order->address }}</td>
                <td class="export">{{ $order->phone }}</td>
                <td class="export">{{ $order->note }}</td>
                <td class="export">{{ $order->date_order }}</td>
                <td class="export">{{ $order->getCurrentStatusAttribute() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html> 