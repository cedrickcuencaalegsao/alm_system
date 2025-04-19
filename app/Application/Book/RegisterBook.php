<?php

namespace App\Application\Book;

use App\Domain\Book\Book;
use App\Domain\Book\BookRepository;

class RegisterBook
{
    private BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function findAll(): array
    {
        return $this->bookRepository->findAll();
    }

    public function findByBookID(string $bookID): ?Book
    {
        return $this->bookRepository->findByBookID($bookID);
    }

    public function updateStockWhenItemBought(string $bookID, int $quantity): void
    {
        $this->bookRepository->updateStockWhenItemBought($bookID, $quantity);
    }

    public function search(string $searchTerm): array
    {
        return $this->bookRepository->search($searchTerm);
    }
}
