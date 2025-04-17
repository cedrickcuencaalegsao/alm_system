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
        $saleData = new SaleModel;
        $saleData->salesID = $sales->getSalesID();
        $saleData->bookID = $sales->getBookID();
        $saleData->userID = $sales->getUserID();
        $saleData->refID = $sales->getRefID();
        $saleData->quantity = $sales->getBookSold();
        $saleData->status = $sales->getStatus();
        $saleData->totalsales = $sales->getTotalSales();
        $saleData->tax = $sales->getTax();
        $saleData->createdAt = $sales->getCreatedAt();
        $saleData->updatedAt = $sales->getUpdatedAt();
        $saleData->save();
    }

    /**
     * Function to update sales data.
     * **/
    public function update(Sale $sales): void
    {
        $saleData = SaleModel::find($sales->getId()) ?? new SaleModel;
        $saleData->salesID = $sales->getSalesID();
        $saleData->bookID = $sales->getBookID();
        $saleData->userID = $sales->getUserID();
        $saleData->refID = $sales->getRefID();
        $saleData->quantity = $sales->getBookSold();
        $saleData->status = $sales->getStatus();
        $saleData->totalsales = $sales->getTotalSales();
        $saleData->tax = $sales->getTax();
        $saleData->createdAt = $sales->getCreatedAt();
        $saleData->updatedAt = $sales->getUpdatedAt();
        $saleData->save();
    }

    /**
     * Function to get sales data by id.
     * **/
    public function findByID(int $id): ?Sale
    {
        $saleData = SaleModel::find('id', $id);
        if (! $saleData) {
            return null;
        }

        return new Sale(
            $saleData->id,
            $saleData->salesID,
            $saleData->bookID,
            $saleData->userID,
            $saleData->refID,
            $saleData->quantity,
            $saleData->status,
            $saleData->totalsales,
            $saleData->tax,
            $saleData->createdAt,
            $saleData->updatedAt,
        );
    }

    /**
     * Function to get sales data by userID.
     * **/
    public function findByUserID(string $userID): ?Sale
    {
        $saleData = SaleModel::where('userID', $userID)->first();
        if (! $saleData) {
            return null;
        }

        return new Sale(
            $saleData->id,
            $saleData->salesID,
            $saleData->bookID,
            $saleData->userID,
            $saleData->refID,
            $saleData->quantity,
            $saleData->status,
            $saleData->totalsales,
            $saleData->tax,
            $saleData->createdAt,
            $saleData->updatedAt,
        );
    }

    /**
     * Function to get sales data by salesID.
     * **/
    public function findBySaleID(string $saleID): ?Sale
    {
        $saleData = SaleModel::where('salesID', $saleID)->first();
        if (! $saleData) {
            return null;
        }

        return new Sale(
            $saleData->id,
            $saleData->salesID,
            $saleData->bookID,
            $saleData->userID,
            $saleData->refID,
            $saleData->quantity,
            $saleData->status,
            $saleData->totalsales,
            $saleData->tax,
            $saleData->createdAt,
            $saleData->updatedAt,
        );
    }

    /**
     * Function to get sales data by refID.
     * **/
    public function findByRefID(string $refID): ?Sale
    {
        $saleData = SaleModel::where('refID', $refID)->first();
        if (! $saleData) {
            return null;
        }

        return new Sale(
            $saleData->id,
            $saleData->salesID,
            $saleData->bookID,
            $saleData->userID,
            $saleData->refID,
            $saleData->quantity,
            $saleData->status,
            $saleData->totalsales,
            $saleData->tax,
            $saleData->createdAt,
            $saleData->updatedAt,
        );
    }

    /**
     * Function to get all sales data.
     * **/
    public function findAll(): array
    {
        return SaleModel::all()->map(fn ($sale) => new Sale(
            $sale->id,
            $sale->salesID,
            $sale->bookID,
            $sale->userID,
            $sale->refID,
            $sale->quantity,
            $sale->status,
            $sale->totalsales,
            $sale->tax,
            $sale->createdAt,
            $sale->updatedAt,
        ))->toArray();
    }

    /**
     * Function to delete sales data.
     * **/
    public function delete(string $saleID)
    {
        $saleData = SaleModel::where('salesID', $saleID)->first();
        if (! $saleData) {
            return null;
        }
    }

    /**
     * Function to get all user orders.
     * **/
    public function findAllUserOrders(string $userID): array
    {
        $saleData = SaleModel::where('userID', $userID)
            ->with('book')
            ->orderBy('createdAt', 'desc')
            ->where('isDeleted', false)
            ->where('status', '!=', 'delivered')
            ->get();
        // dd($saleData);
        if (! $saleData) {
            return null;
        }

        return $saleData->map(fn ($sale) => new Sale(
            $sale->id,
            $sale->salesID,
            $sale->bookID,
            $sale->userID,
            $sale->refID,
            $sale->quantity,
            $sale->status,
            $sale->totalsales,
            $sale->tax,
            $sale->createdAt,
            $sale->updatedAt,
            $sale->book->bookname,
            $sale->book->bookprice,
            $sale->book->image,
            $sale->book->author,
            $sale->book->bookcategory,
        ))->toArray();
    }
}
