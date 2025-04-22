<?php

namespace App\Http\Controllers\Dashboard\WEB;

use App\Application\Sales\RegisterSales;
use App\Application\Book\RegisterBook;
use App\Application\User\RegisterUser;
use App\Http\Controllers\Controller;

class DashboardWEBController extends Controller
{
    protected $registerSales;
    protected $registerBook;
    protected $registerUser;

    public function __construct(RegisterSales $registerSales, RegisterBook $registerBook, RegisterUser $registerUser)
    {
        $this->registerSales = $registerSales;
        $this->registerBook = $registerBook;
        $this->registerUser = $registerUser;
    }

    public function index()
    {
        $data = [
            'MonthlySales' => $this->getMonthlySales(),
            'MonthlyOrders' => $this->getMonthlyOrders(),
            'MonthlySalesPercentage' => $this->getMonthlySalesPercentage(),
            'MonthlyOrdersPercentage' => $this->getMonthlyOrdersPercentage(),
            'booksInStockCount' => $this->getBooksInStockCount(),
            'userActivity' => $this->getUserActivity(),
            'topSellingBook' => $this->getTopSellingBook(),
            'latestSales' => $this->getLatestSales(),
            'get5lowStockBooks' => $this->get5LowStockBooks(),
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

    public function getUserActivity()
    {
        $userActivity = $this->registerUser->getUserActivity();
        return $userActivity;
    }

    public function getTopSellingBook()
    {
        $topSellingBook = $this->registerBook->getTopSellingBook();
        return $topSellingBook;
    }

    public function getLatestSales()
    {
        $latestSales = $this->registerSales->getLatestSales();
        return $latestSales;
    }

    public function get5LowStockBooks()
    {
        $get5lowStockBooks = $this->registerBook->get5LowStockBooks();
        return $get5lowStockBooks;
    }
}
