<?php

namespace App\Domain\Sale;

interface SaleRepository
{
    public function create(Sale $sales);
    public function update(Sale $sale);
    public function findBySaleID(string $saleID): ?Sale;
    public function findAll(): array;
}
