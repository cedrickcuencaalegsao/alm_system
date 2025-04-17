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

    private ?string $bookname;

    private ?float $bookprice;

    private ?string $image;

    private ?string $author;

    private ?string $bookcategory;

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
        ?string $bookname,
        ?float $bookprice,
        ?string $image,
        ?string $author,
        ?string $bookcategory,
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
        $this->bookname = $bookname;
        $this->bookprice = $bookprice;
        $this->image = $image;
        $this->author = $author;
        $this->bookcategory = $bookcategory;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'salesID' => $this->salesID,
            'bookID' => $this->bookID,
            'userID' => $this->userID,
            'refID' => $this->refID,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'totalsales' => $this->totalsales,
            'tax' => $this->tax,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'bookname' => $this->bookname,
            'bookprice' => $this->bookprice,
            'image' => $this->image,
            'author' => $this->author,
            'bookcategory' => $this->bookcategory,
        ];
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

    public function getQuantity(): ?int
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

    public function getBookName(): ?string
    {
        return $this->bookname;
    }

    public function getBookPrice(): ?float
    {
        return $this->bookprice;
    }

    public function getBookImage(): ?string
    {
        return $this->image;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function getBookCategory(): ?string
    {
        return $this->bookcategory;
    }
}
