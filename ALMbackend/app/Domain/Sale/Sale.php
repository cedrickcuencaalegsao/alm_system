<?php

namespace App\Domain\Sale;

class Sale
{
    private ?int $id;
    private ?string $salesID;
    private ?int $booksold;
    private ?float $totalsales;
    private ?string $createdAt;
    private ?string $updatedAt;

    public function __construct(
        ?int $id = null,
        ?string $salesID = null,
        ?int $booksold = null,
        ?float $totalsales = null,
        ?string $createdAt = null,
        ?string $updatedAt = null,
    ) {
        $this->id = $id;
        $this->salesID = $salesID;
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
    public function getTotalSales(): int|null
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
