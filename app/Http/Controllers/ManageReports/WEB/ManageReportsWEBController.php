<?php

namespace App\Http\Controllers\ManageReports\WEB;

use App\Application\Sales\RegisterSales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageReportsWEBController extends Controller
{
    private $registerSales;

    public function __construct(RegisterSales $registerSales)
    {
        $this->registerSales = $registerSales;
    }

    public function index(Request $request)
    {
        // Dashboard card data
        $cardData = [
            'totalRevenue' => $this->registerSales->getTotalRevenue(),
            'totalOrders' => $this->registerSales->getTotalOrders(),
            'conversionRate' => $this->registerSales->getConversionRate(),
            'avgOrderValue' => $this->registerSales->getAverageOrderValue(),
        ];

        $salesChartData = $this->registerSales->getSalesByMonth();

        $salesDistributionData = $this->registerSales->getSalesByCategory();

        $productPerformanceData = $this->registerSales->topSellingBooks();

        // Category Distribution Chart Data
        $categoryDistributionData = $this->registerSales->getSalesByCategory();

        // Customer Retention Chart Data
        $customerRetentionData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'data' => [95, 92, 94, 90, 93, 96],
        ];

        // Customer Acquisition Chart Data
        $customerAcquisitionData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'data' => [25, 32, 18, 27, 35, 30],
        ];

        $perPage = $request->input('per_page', 5);
        $salesData = $this->registerSales->findAllPaginated($perPage);

        $productData = [
            [
                'id' => 'P001',
                'name' => 'Book Title 1',
                'category' => 'Fiction',
                'price' => 24.99,
                'units_sold' => 45,
                'revenue' => 1124.55,
                'stock' => 23,
                'status' => 'In Stock',
            ],
            [
                'id' => 'P002',
                'name' => 'Book Title 2',
                'category' => 'Non-Fiction',
                'price' => 19.99,
                'units_sold' => 38,
                'revenue' => 759.62,
                'stock' => 15,
                'status' => 'In Stock',
            ],
            [
                'id' => 'P003',
                'name' => 'Book Title 3',
                'category' => 'Science',
                'price' => 15.99,
                'units_sold' => 52,
                'revenue' => 831.48,
                'stock' => 8,
                'status' => 'Low Stock',
            ],
            [
                'id' => 'P004',
                'name' => 'Book Title 4',
                'category' => 'Fiction',
                'price' => 29.99,
                'units_sold' => 29,
                'revenue' => 869.71,
                'stock' => 0,
                'status' => 'Out of Stock',
            ],
            [
                'id' => 'P005',
                'name' => 'Book Title 5',
                'category' => 'Biography',
                'price' => 22.99,
                'units_sold' => 33,
                'revenue' => 758.67,
                'stock' => 12,
                'status' => 'In Stock',
            ],
        ];

        // Sample Customer Data
        $customerData = [
            [
                'id' => 'C001',
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'orders' => 5,
                'total_spent' => 249.95,
                'avg_order' => 49.99,
                'first_purchase' => '2023-01-15',
                'last_purchase' => '2023-06-12',
            ],
            [
                'id' => 'C002',
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'orders' => 3,
                'total_spent' => 89.97,
                'avg_order' => 29.99,
                'first_purchase' => '2023-02-28',
                'last_purchase' => '2023-05-19',
            ],
            [
                'id' => 'C003',
                'name' => 'Robert Johnson',
                'email' => 'robert.j@example.com',
                'orders' => 8,
                'total_spent' => 399.92,
                'avg_order' => 49.99,
                'first_purchase' => '2022-11-05',
                'last_purchase' => '2023-06-16',
            ],
            [
                'id' => 'C004',
                'name' => 'Emily Davis',
                'email' => 'emily.d@example.com',
                'orders' => 2,
                'total_spent' => 49.98,
                'avg_order' => 24.99,
                'first_purchase' => '2023-04-22',
                'last_purchase' => '2023-06-02',
            ],
            [
                'id' => 'C005',
                'name' => 'Michael Wilson',
                'email' => 'michael.w@example.com',
                'orders' => 7,
                'total_spent' => 349.93,
                'avg_order' => 49.99,
                'first_purchase' => '2022-12-15',
                'last_purchase' => '2023-06-17',
            ],
        ];

        // Combine all chart data
        $chartData = [
            'salesChart' => $salesChartData,
            'salesDistribution' => $salesDistributionData,
            'productPerformance' => $productPerformanceData,
            'categoryDistribution' => $categoryDistributionData,
            'customerRetention' => $customerRetentionData,
            'customerAcquisition' => $customerAcquisitionData,
        ];

        // Combine all table data
        $tableData = [
            'sales' => $salesData,
            'products' => $productData,
            'customers' => $customerData,
        ];

        return view('Page.ManageReports.managereports', compact('cardData', 'chartData', 'tableData'));
    }
}
