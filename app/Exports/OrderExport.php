<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Services\StatisticService;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromQuery, WithHeadings
{

    use Exportable;
    private $month;

    /**
     * Contructer
     *
     * @param int $month Month now
     */
    public function __construct(int $month)
    {
        $this->month = $month;
    }

    /**
     * Query model get data
     *
     * @return void
     */
    public function query()
    {
        return Order::query()->whereMonth('date_order', $this->month);
    }

    public function headings(): array
    {
        return [
            'Id',
            'Date Order',
            'Status',
            'Note',
            'User Id',
            'Adress',
            'Phone',
            'Created at',
            'Updated at'
        ];
    }


    /**
     * Title of Export file
     *
     * @return month
     */
    public function title(): string
    {
        return 'Month ' . $this->month;
    }
}
