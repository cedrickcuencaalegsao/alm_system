<?php

namespace App\Domain\Sale;

class Sale
{
    private ?int $id;

    private ?string $salesID;

    private ?string $bookID;

    private ?string $userID;

    private ?string $refID;

    private ?int $quantity;

    private ?string $status;

    private ?float $tax;

    private ?float $totalsales;

    private ?string $createdAt;

    private ?string $updatedAt;

    public function __construct(
        ?int $id,
        ?string $salesID,
        ?string $bookID,
        ?string $userID,
        ?string $refID,
        ?int $quantity,
        ?string $status,
        ?float $totalsales,
        ?float $tax,
        ?string $createdAt,
        ?string $updatedAt,
    ) {
        $this->id = $id;
        $this->salesID = $salesID;
        $this->bookID = $bookID;
        $this->userID = $userID;
        $this->refID = $refID;
        $this->quantity = $quantity;
        $this->status = $status;
        $this->totalsales = $totalsales;
        $this->tax = $tax;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSalesID(): ?string
    {
        return $this->salesID;
    }

    public function getBookID(): ?string
    {
        return $this->bookID;
    }

    public function getUserID(): ?string
    {
        return $this->userID;
    }

    public function getRefID(): ?string
    {
        return $this->refID;
    }

    public function getBookSold(): ?int
    {
        return $this->quantity;
    }

    public function getTotalSales(): ?float
    {
        return $this->totalsales;
    }

    public function getTax(): ?float
    {
        return $this->tax;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }
}
