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

    public function findall()
    {
        return $this->salesRepository->findAll();
    }

    public function findAllPaginated(int $paginate)
    {
        return $this->salesRepository->findAllPaginated($paginate);
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

    public function countAll()
    {
        return $this->salesRepository->countAll();
    }

    public function countPending()
    {
        return $this->salesRepository->countPending();
    }

    public function countProcessing()
    {
        return $this->salesRepository->countProcessing();
    }

    public function countDelivering()
    {
        return $this->salesRepository->countDelivering();
    }

    public function countCompleted()
    {
        return $this->salesRepository->countCompleted();
    }

    public function searchSales(string $search, int $perPage)
    {
        return $this->salesRepository->searchSales($search, $perPage);
    }

    public function updateStatus(string $saleID, string $status): void
    {
        $data = [
            'saleID' => $saleID,
            'status' => $status,
            'updatedAt' => Carbon::now(),
        ];
        $this->salesRepository->updateStatus($data);
    }

    public function getTotalRevenue(): ?float
    {
        return $this->salesRepository->getTotalRevenue();
    }

    public function getTotalOrders(): ?int
    {
        return $this->salesRepository->getTotalOrders();
    }

    public function getConversionRate(): ?float
    {
        return $this->salesRepository->getConversionRate();
    }

    public function getAverageOrderValue(): ?float
    {
        return $this->salesRepository->getAverageOrderValue();
    }
}
