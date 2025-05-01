<?php

namespace App\Http\Controllers\ManageReports\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Application\Sales\RegisterSales;

class ManageReportsWEBController extends Controller
{
    private $registerSales;

    public function __construct(RegisterSales $registerSales)
    {
        $this->registerSales = $registerSales;
    }

    public function index()
    {
        $cardData = [
            'totalRevenue' => $this->registerSales->getTotalRevenue(),
            'totalOrders' => $this->registerSales->getTotalOrders(),
            'conversionRate' => $this->registerSales->getConversionRate(),
            'avgOrderValue' => $this->registerSales->getAverageOrderValue(),
        ];
        return view('Page.ManageReports.managereports', compact('cardData'));
    }
}
