<?php

namespace App\Http\Controllers\ManageReports\WEB;

use App\Application\Sales\RegisterSales;
use App\Application\User\RegisterUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageReportsWEBController extends Controller
{
    private $registerSales;
    private $registerUser;

    public function __construct(RegisterSales $registerSales, RegisterUser $registerUser)
    {
        $this->registerSales = $registerSales;
        $this->registerUser = $registerUser;
    }

    public function index(Request $request)
    {
        $cardData = [
            'totalRevenue' => $this->registerSales->getTotalRevenue(),
            'totalOrders' => $this->registerSales->getTotalOrders(),
            'conversionRate' => $this->registerSales->getConversionRate(),
            'avgOrderValue' => $this->registerSales->getAverageOrderValue(),
        ];

        $salesChartData = $this->registerSales->getSalesByMonth();

        $salesDistributionData = $this->registerSales->getSalesByCategory();

        $bookPerformanceData = $this->registerSales->topSellingBooks();

        $categoryDistributionData = $this->registerSales->getSalesByCategory();

        $customerPerformanceData = $this->registerSales->getCustomerPerformance();

        $customerAcquisitionData = $this->registerUser->getUserPerMonth();
        // dd($customerAcquisitionData);

        $salesPerPage = $request->input('per_page', 5);
        $salesData = $this->registerSales->findAllPaginated($salesPerPage);

        $bookPerPage = $request->input('per_page', 5);
        $bookData = $this->registerSales->findAllPaginated($bookPerPage);

        $chartData = [
            'salesChart' => $salesChartData,
            'salesDistribution' => $salesDistributionData,
            'bookPerformance' => $bookPerformanceData,
            'categoryDistribution' => $categoryDistributionData,
            'customerPerformance' => $customerPerformanceData,
            'customerAcquisition' => $customerAcquisitionData,
        ];

        $tableData = [
            'sales' => $salesData,
            'books' => $bookData,
        ];

        return view('Page.ManageReports.managereports', compact('cardData', 'chartData', 'tableData'));
    }
}
