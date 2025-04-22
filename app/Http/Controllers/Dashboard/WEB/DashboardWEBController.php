<?php

namespace App\Http\Controllers\Dashboard\WEB;

use App\Application\Sales\RegisterSales;
use App\Application\Book\RegisterBook;
use App\Http\Controllers\Controller;

class DashboardWEBController extends Controller
{
    protected $registerSales;
    protected $registerBook;

    public function __construct(RegisterSales $registerSales, RegisterBook $registerBook)
    {
        $this->registerSales = $registerSales;
        $this->registerBook = $registerBook;
    }

    public function index()
    {
        $data = [
            'MonthlySales' => $this->getMonthlySales(),
            'MonthlyOrders' => $this->getMonthlyOrders(),
            'MonthlySalesPercentage' => $this->getMonthlySalesPercentage(),
            'MonthlyOrdersPercentage' => $this->getMonthlyOrdersPercentage(),
            'booksInStockCount' => $this->getBooksInStockCount(),
        ];

        return view('Page.Dashboard.dashboard', compact('data'));
    }

    public function getMonthlySales()
    {
        $thisMonthSales = $this->registerSales->thisMonthSales();
        $MonthlySales = number_format($thisMonthSales, 2);

        return $MonthlySales;
    }

    public function getMonthlySalesPercentage()
    {
        $thisMonthSalesPercentage = $this->registerSales->thisMonthSalesPercentage();
        return $thisMonthSalesPercentage;
    }

    public function getMonthlyOrders()
    {
        $thisMonthOrders = $this->registerSales->thisMonthOrders();
        return $thisMonthOrders;
    }

    public function getMonthlyOrdersPercentage()
    {
        $thisMonthOrdersPercentage = $this->registerSales->thisMonthOrdersPercentage();
        return $thisMonthOrdersPercentage;
    }

    public function getBooksInStockCount()
    {
        $booksInStockCount = $this->registerBook->getBooksInStockCount();
        return $booksInStockCount;
    }
}
