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
        $saleData->quantity = $sales->getQuantity();
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
        $saleData->quantity = $sales->getQuantity();
        $saleData->status = $sales->getStatus();
        $saleData->totalsales = $sales->getTotalSales();
        $saleData->tax = $sales->getTax();
        $saleData->createdAt = $sales->getCreatedAt();
        $saleData->updatedAt = $sales->getUpdatedAt();
        $saleData->save();
    }

    /**
     * Function to update sales status.
     * **/
    public function updateStatus(array $data): void
    {
        $saleData = SaleModel::where('salesID', $data['saleID'])->first();
        if (! $saleData) {
            return;
        }
        $saleData->status = $data['status'];
        $saleData->updatedAt = $data['updatedAt'];
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
            $saleData->book->bookname,
            $saleData->book->bookprice,
            $saleData->book->image,
            $saleData->book->author,
            $saleData->book->bookcategory,
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
            $saleData->book->bookname,
            $saleData->book->bookprice,
            $saleData->book->image,
            $saleData->book->author,
            $saleData->book->bookcategory,
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
            $saleData->book->bookname,
            $saleData->book->bookprice,
            $saleData->book->image,
            $saleData->book->author,
            $saleData->book->bookcategory,
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
            $saleData->book->bookname,
            $saleData->book->bookprice,
            $saleData->book->image,
            $saleData->book->author,
            $saleData->book->bookcategory,
        );
    }

    /**
     * Function to get all sales data.
     * **/
    public function findAll(): ?array
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
            $sale->book->bookname,
            $sale->book->bookprice,
            $sale->book->image,
            $sale->book->author,
            $sale->book->bookcategory,
        ))->toArray();
    }

    /**
     * Function to get paginated data from the table user.
     * **/
    public function findAllPaginated(int $perPage)
    {
        $sales = SaleModel::where('isDeleted', false)->orderBy('createdAt', 'asc')->paginate($perPage);

        $sales->getCollection()->transform(function ($sale) {
            return new Sale(
                id: $sale->id,
                salesID: $sale->salesID,
                bookID: $sale->bookID,
                userID: $sale->userID,
                refID: $sale->refID,
                quantity: $sale->quantity,
                status: $sale->status,
                totalsales: $sale->totalsales,
                tax: $sale->tax,
                createdAt: $sale->createdAt,
                updatedAt: $sale->updatedAt,
                bookname: $sale->book->bookname,
                bookprice: $sale->book->bookprice,
                image: $sale->book->image,
                author: $sale->book->author,
                bookcategory: $sale->book->bookcategory,
            );
        });

        return $sales;
    }

    /**
     * Function to search sales data.
     * **/
    public function searchSales(string $search, int $perPage)
    {
        $sales = SaleModel::where('isDeleted', false)
            ->where('salesID', 'like', "%{$search}%")
            ->orWhere('bookID', 'like', "%{$search}%")
            ->orWhere('userID', 'like', "%{$search}%")
            ->orWhere('refID', 'like', "%{$search}%")
            ->orWhere('status', 'like', "%{$search}%")
            ->orderBy('createdAt', 'asc')
            ->paginate($perPage);

        $sales->getCollection()->transform(function ($sale) {
            return new Sale(
                id: $sale->id,
                salesID: $sale->salesID,
                bookID: $sale->bookID,
                userID: $sale->userID,
                refID: $sale->refID,
                quantity: $sale->quantity,
                status: $sale->status,
                totalsales: $sale->totalsales,
                tax: $sale->tax,
                createdAt: $sale->createdAt,
                updatedAt: $sale->updatedAt,
                bookname: $sale->book->bookname,
                bookprice: $sale->book->bookprice,
                image: $sale->book->image,
                author: $sale->book->author,
                bookcategory: $sale->book->bookcategory,
            );
        });

        return $sales;
    }

    /**
     * Function to delete sales data.
     * **/
    public function delete(string $saleID): void
    {
        $saleData = SaleModel::where('salesID', $saleID)->first();
        if (! $saleData) {
            return;
        }
    }

    /**
     * Function to get all user orders.
     * **/
    public function findAllUserOrders(string $userID): ?array
    {
        $saleData = SaleModel::where('userID', $userID)
            ->with('book')
            ->orderBy('createdAt', 'desc')
            ->where('isDeleted', false)
            ->get();
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

    public function thisMonthSales(): ?float
    {
        return SaleModel::where('createdAt', '>=', now()->startOfMonth())
            ->where('createdAt', '<=', now()->endOfMonth())
            ->sum('totalsales');
    }

    public function thisMonthSalesPercentage(): ?array
    {
        $lastMonthSales = SaleModel::where('createdAt', '>=', now()->subMonth()->startOfMonth())
            ->where('createdAt', '<=', now()->subMonth()->endOfMonth())
            ->sum('totalsales');

        if ($lastMonthSales === 0) {
            return [
                'value' => $lastMonthSales,
                'type' => 'Neutral',
            ];
        }

        $percentage = ($this->thisMonthSales() - $lastMonthSales) / $lastMonthSales * 100;
        $formattedPercentage = number_format($percentage, 2);

        return [
            'value' => abs($formattedPercentage),
            'type' => $percentage > 0 ? 'increase' : ($percentage < 0 ? 'decrease' : 'neutral'),
        ];
    }

    public function thisMonthOrders(): ?int
    {
        return SaleModel::where('createdAt', '>=', now()->startOfMonth())
            ->where('createdAt', '<=', now()->endOfMonth())
            ->count();
    }

    public function thisMonthOrdersPercentage(): ?array
    {
        $lastMonthOrders = SaleModel::where('createdAt', '>=', now()->subMonth()->startOfMonth())
            ->where('createdAt', '<=', now()->subMonth()->endOfMonth())
            ->count();
        if ($lastMonthOrders === 0) {
            return [
                'value' => $lastMonthOrders,
                'type' => 'Neutral',
            ];
        }

        $percentage = ($this->thisMonthOrders() - $lastMonthOrders) / $lastMonthOrders * 100;
        $formattedPercentage = number_format($percentage, 2);

        return [
            'value' => abs($formattedPercentage),
            'type' => $percentage > 0 ? 'increase' : ($percentage < 0 ? 'decrease' : 'neutral'),
        ];
    }

    public function getLatestSales(): array
    {
        return SaleModel::orderBy('createdAt', 'desc')->take(8)->get()->map(fn ($sale) => new Sale(
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

    /**
     * Function to count all sales.
     * **/
    public function countAll(): ?int
    {
        return count(SaleModel::where('status', '!=', 'cancelled')->get());
    }

    /**
     * Function to count pending orders.
     * **/
    public function countPending(): ?int
    {
        return count(SaleModel::where('status', 'pending')->get());
    }

    /**
     * Function to count processing orders.
     * **/
    public function countProcessing(): ?int
    {
        return count(SaleModel::where('status', 'processing')->get());
    }

    /**
     * Function to count delivering orders.
     * **/
    public function countDelivering(): ?int
    {
        return count(SaleModel::where('status', 'delivering')->get());
    }

    /**
     * Function to count completed orders.
     * **/
    public function countCompleted(): ?int
    {
        return count(SaleModel::where('status', 'delivered')->get());
    }
}
