<?php

namespace App\Infrastructure\Persistance\Eloquent\Sale;

use App\Domain\Sale\Sale;
use App\Domain\Sale\SaleRepository;

class EloquentSalesRepository implements SaleRepository
{
    /**
     * Function to create new Sales.
     * **/
    public function create(Sale $sales): void
    {
        $saleData = new SaleModel();
        $saleData->salesID = $sales->getSalesID();
        $saleData->booksold = $sales->getBookSold();
        $saleData->totalsales = $sales->getTotalSales();
        $saleData->createdAt = $sales->craetedAt();
        $saleData->updatedAt = $sales->updatedAt();
        $saleData->save();
    }
    /**
     * Function to update sales data.
     * **/
    public function update(Sale $sales): void
    {
        $saleData = SaleModel::find($sales->getId()) ?? new SaleModel();
        $saleData->salesID = $sales->getSalesID();
        $saleData->booksold = $sales->getBookSold();
        $saleData->totalsales = $sales->getTotalSales();
        $saleData->createdAt = $sales->craetedAt();
        $saleData->updatedAt = $sales->updatedAt();
        $saleData->save();
    }
    /**
     * Function to get sales data by id.
     * **/
    public function findByID(int $id): Sale|null
    {
        $saleData = SaleModel::find('id', $id);
        if (!$saleData) {
            return null;
        }
        return new Sale(
            $saleData->id,
            $saleData->salesID,
            $saleData->booksold,
            $saleData->totalsales,
            $saleData->createdAt,
            $saleData->updatedAt,
        );
    }
    /**
     * Function to get sales data by salesID.
     * **/
    public function findBySaleID(string $saleID): Sale|null
    {
        $saleData = SaleModel::where('saleID', $saleID);
        if (!$saleData) {
            return null;
        }
        return new Sale(
            $saleData->id,
            $saleData->salesID,
            $saleData->booksold,
            $saleData->totalsales,
            $saleData->createdAt,
            $saleData->updatedAt,
        );
    }
    /**
     * Function to get all sales data.
     * **/
    public function findAll(): array
    {
        return SaleModel::all()->map(fn($sale) => new Sale(
            id: $sale->id,
            salesID: $sale->salesID,
            booksold: $sale->booksold,
            totalsales: $sale->totalsales,
            createdAt: $sale->createdAt,
            updatedAt: $sale->updatedAt,
        ))->toArray();
    }
}
