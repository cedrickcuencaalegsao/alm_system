<?php

namespace App\Domain\Sale;

class Sale
{
    private ?int $id;
    private ?string $salesID;
    private ?string $userID;
    private ?int $booksold;
    private ?float $totalsales;
    private ?string $createdAt;
    private ?string $updatedAt;

    public function __construct(
        ?int $id = null,
        ?string $salesID = null,
        ?string $userID = null,
        ?int $booksold = null,
        ?float $totalsales = null,
        ?string $createdAt = null,
        ?string $updatedAt = null,
    ) {
        $this->id = $id;
        $this->salesID = $salesID;
        $this->userID = $userID;
        $this->booksold = $booksold;
        $this->totalsales = $totalsales;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'salesID' => $this->salesID,
            'userID' => $this->userID,
            'booksold' => $this->booksold,
            'totalsales' => $this->totalsales,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }
    public function getId(): int|null
    {
        return $this->id;
    }
    public function getSalesID(): string|null
    {
        return $this->salesID;
    }
    public function getUserID(): string|null
    {
        return $this->userID;
    }
    public function getBookSold(): int|null
    {
        return $this->booksold;
    }
    public function getTotalSales(): float|null
    {
        return $this->totalsales;
    }
    public function craetedAt(): string|null
    {
        return $this->createdAt;
    }
    public function updatedAt(): string|null
    {
        return $this->updatedAt;
    }
}
