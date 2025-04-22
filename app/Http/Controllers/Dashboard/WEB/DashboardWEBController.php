<?php

namespace App\Http\Controllers\Dashboard\WEB;

use App\Application\Sales\RegisterSales;
use App\Http\Controllers\Controller;

class DashboardWEBController extends Controller
{
    protected $registerSales;

    public function __construct(RegisterSales $registerSales)
    {
        $this->registerSales = $registerSales;
    }

    public function index()
    {
        $thisMonthSales = $this->registerSales->thisMonthSales();
        $MonthlySales = number_format($thisMonthSales, 2);
        $thisMonthSalesPercentage = $this->registerSales->thisMonthSalesPercentage();

        $thisMonthOrders = $this->registerSales->thisMonthOrders();
        $thisMonthOrdersPercentage = $this->registerSales->thisMonthOrdersPercentage();

        $data = [
            'MonthlySales' => $MonthlySales,
            'MonthlyOrders' => $thisMonthOrders,
            'MonthlySalesPercentage' => $thisMonthSalesPercentage,
            'MonthlyOrdersPercentage' => $thisMonthOrdersPercentage,
        ];

        return view('Page.Dashboard.dashboard', compact('data'));
    }
}
