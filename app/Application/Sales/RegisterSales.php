<?php

namespace App\Application\Sales;

use App\Domain\Sale\Sale;
use App\Domain\Sale\SaleRepository;
use Carbon\Carbon;

class RegisterSales
{
    private SaleRepository $salesRepository;

    public function __construct(SaleRepository $salesRepository)
    {
        $this->salesRepository = $salesRepository;
    }

    public function createSales(array $data)
    {
        $sales = new Sale(
            null,
            $data['salesID'],
            $data['bookID'],
            $data['userID'],
            $data['refID'],
            $data['quantity'],
            $data['status'],
            $data['totalsales'],
            $data['tax'],
            Carbon::now(),
            Carbon::now(),
            null,
            null,
            null,
            null,
            null,
            null,
            null,
        );

        return $this->salesRepository->create($sales);
    }

    public function findBySalesID(string $salesID)
    {
        return $this->salesRepository->findBySaleID($salesID);
    }

    public function findByRefID(string $refID)
    {
        return $this->salesRepository->findByRefID($refID);
    }

    public function findAllUserOrders(string $userID)
    {
        return $this->salesRepository->findAllUserOrders($userID);
    }

    public function thisMonthSales()
    {
        return $this->salesRepository->thisMonthSales();
    }

    public function thisMonthSalesPercentage()
    {
        return $this->salesRepository->thisMonthSalesPercentage();
    }

    public function thisMonthOrders()
    {
        return $this->salesRepository->thisMonthOrders();
    }

    public function thisMonthOrdersPercentage()
    {
        return $this->salesRepository->thisMonthOrdersPercentage();
    }

    public function getLatestSales()
    {
        return $this->salesRepository->getLatestSales();
    }
}
