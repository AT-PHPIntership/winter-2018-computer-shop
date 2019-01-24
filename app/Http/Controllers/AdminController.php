<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StatisticService;
use Excel;
use App\Exports\OrderExport;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    /**
     * The function return home of admin page
     *
     * @return void
     */
    public function home()
    {
        $arrayData = app(StatisticService::class)->getData();
        return view('admin.home', compact('arrayData'));
    }

    /**
     * Export file
     *
     * @return file
     */
    public function excel()
    {
        $month= Carbon::now()->month;
        return (new OrderExport($month))->download('month_'.$month.'_order.xlsx');
    }
}
