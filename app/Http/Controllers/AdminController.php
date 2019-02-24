<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StatisticService;
use App\Services\OrderService;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        return app(OrderService::class)->orderExport();
    }
}
