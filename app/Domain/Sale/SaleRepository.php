<?php

namespace App\Domain\Sale;

interface SaleRepository
{
    public function create(Sale $sales);

    public function update(Sale $sale);

    public function delete(string $saleID);

    public function findByID(int $id): ?Sale;

    public function findByUserID(string $userID): ?Sale;

    public function findBySaleID(string $saleID): ?Sale;

    public function findByRefID(string $refID): ?Sale;

    public function findAll(): array;

    public function findAllUserOrders(string $userID): array;

    public function thisMonthSales(): ?float;

    public function thisMonthSalesPercentage(): array;

    public function thisMonthOrders(): ?int;

    public function thisMonthOrdersPercentage(): array;

    public function getLatestSales(): array;
}
