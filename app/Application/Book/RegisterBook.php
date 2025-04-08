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
    public function findAll():array{
        return $this->bookRepository->findAll();
    }
}

