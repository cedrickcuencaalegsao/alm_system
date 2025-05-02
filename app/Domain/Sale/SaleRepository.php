<?php

namespace App\Domain\Sale;

interface SaleRepository
{
    public function create(Sale $sales);

    public function update(Sale $sale);

    public function updateStatus(array $data): void;

    public function delete(string $saleID);

    public function findByID(int $id): ?Sale;

    public function findByUserID(string $userID): ?Sale;

    public function findBySaleID(string $saleID): ?Sale;

    public function findByRefID(string $refID): ?Sale;

    public function findAll(): ?array;

    public function findAllUserOrders(string $userID): ?array;

    public function thisMonthSales(): ?float;

    public function thisMonthSalesPercentage(): ?array;

    public function thisMonthOrders(): ?int;

    public function thisMonthOrdersPercentage(): ?array;

    public function getLatestSales(): ?array;

    public function findAllPaginated(int $perPage);

    public function countAll(): ?int;

    public function countPending(): ?int;

    public function countProcessing(): ?int;

    public function countDelivering(): ?int;

    public function countCompleted(): ?int;

    public function searchSales(string $search, int $perPage);

    public function getTotalRevenue(): ?float;

    public function getTotalOrders(): ?int;

    public function getConversionRate(): ?float;

    public function getAverageOrderValue(): ?float;

    public function getSalesByMonth(): ?array;

    public function getSalesByCategory(): ?array;

    public function topSellingBooks(): ?array;
}
