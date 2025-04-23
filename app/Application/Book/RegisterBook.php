<?php

namespace App\Application\Book;

use App\Domain\Book\Book;
use App\Domain\Book\BookRepository;
use Carbon\Carbon;

class RegisterBook
{
    private BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function create(array $data): void
    {
        $newBook = new Book(
            null,
            $data['bookID'],
            $data['bookname'],
            $data['bookdetails'],
            $data['author'],
            $data['stocks'],
            $data['bookcategory'],
            $data['datepublish'],
            $data['image'],
            $data['bookprice'],
            false,
            Carbon::now(),
            Carbon::now(),
            null,
        );
        $this->bookRepository->create($newBook);
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

    public function getBooksInStockCount(): array
    {
        return $this->bookRepository->getBooksInStockCount();
    }

    public function getBestSellingBook(): array
    {
        return $this->bookRepository->getBestSellingBook();
    }

    public function getTopSellingBook(): array
    {
        return $this->bookRepository->getTopSellingBook();
    }

    public function get5LowStockBooks(): array
    {
        return $this->bookRepository->get5LowStockBooks();
    }
}
