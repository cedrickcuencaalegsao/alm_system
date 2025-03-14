<?php

namespace App\Infrastructure\Persistance\Eloquent\Book;

use App\Domain\Book\Book;
use App\Domain\Book\BookRepository;
use App\Infrastructure\Persistance\Eloquent\User\UserModel;

class EloqeuntBookRepository implements BookRepository
{
    /**
     * Function to get book data by id.
     * **/
    public function findByID(int $id): Book|null
    {
        $bookData = BookModel::find($id);
        if (!$bookData) {
            return null;
        }
        return new Book(
            $bookData->id,
            $bookData->bookID,
            $bookData->bookname,
            $bookData->bookdetails,
            $bookData->author,
            $bookData->stock,
            $bookData->category,
            $bookData->datepublish,
            $bookData->image,
            $bookData->price,
            $bookData->createdAt,
            $bookData->updatedAt,
        );
    }
    /**
     * Function book data by bookID.
     * **/
    public function findByBookID(string $bookID): Book|null
    {
        $bookData = BookModel::where('bookID', $bookID)->first();
        if (!$bookData) {
            return null;
        }
        return new Book(
            $bookData->id,
            $bookData->bookID,
            $bookData->bookname,
            $bookData->bookdetails,
            $bookData->author,
            $bookData->stock,
            $bookData->category,
            $bookData->datepublish,
            $bookData->image,
            $bookData->price,
            $bookData->createdAt,
            $bookData->updatedAt,
        );
    }
    /**
     * Function to create a new book.
     * **/
    public function create(Book $book): void
    {
        $newBook = new BookModel();
        $newBook->bookID = $book->getBookID();
        $newBook->bookname = $book->getBookName();
        $newBook->bookdetails = $book->getBookDetails();
        $newBook->author = $book->getAuthor();
        $newBook->stock = $book->getStock();
        $newBook->category = $book->getCategory();
        $newBook->datepublish = $book->getDatePublish();
        $newBook->image = $book->getImage();
        $newBook->price = $book->getPrice();
        $newBook->createdAt = $book->createdAt();
        $newBook->updatedAt = $book->updatedAt();
        $newBook->save();
    }
    /**
     * Function to update book data.
     * **/
    public function update(Book $book): void
    {
        $newBookData = BookModel::find($book->getId()) ?? new BookModel();
        $newBookData->bookID = $book->getBookID();
        $newBookData->bookname = $book->getBookName();
        $newBookData->bookdetails = $book->getBookDetails();
        $newBookData->author = $book->getAuthor();
        $newBookData->stock = $book->getStock();
        $newBookData->category = $book->getCategory();
        $newBookData->datepublish = $book->getDatePublish();
        $newBookData->image = $book->getImage();
        $newBookData->price = $book->getPrice();
        $newBookData->createdAt = $book->createdAt();
        $newBookData->updatedAt = $book->updatedAt();
        $newBookData->save();
    }
    /**
     * Function to find all book data.
     * **/
    public function findAll(): array
    {
        return UserModel::all()->map(fn($book) => new Book(
            id: $book->id,
            bookID: $book->bookID,
            bookname: $book->bookname,
            bookdetails: $book->bookdetails,
            author: $book->author,
            stock: $book->stock,
            category: $book->category,
            datepublish: $book->datepublish,
            image: $book->image,
            price: $book->price,
            createdAt: $book->createdAt,
            updatedAt: $book->updatedAt,
        ))->toArray();
    }
    /**
     * Function to find book by name;
     **/
    public function findByName(string $bookname): Book|null
    {
        $bookData = BookModel::where('bookname', $bookname)->first();
        if (!$bookData) {
            return null;
        }
        return new Book(
            $bookData->id,
            $bookData->bookID,
            $bookData->bookname,
            $bookData->bookdetails,
            $bookData->author,
            $bookData->stock,
            $bookData->category,
            $bookData->datepublish,
            $bookData->image,
            $bookData->price,
            $bookData->createdAt,
            $bookData->updatedAt,
        );
    }
    /**
     * Function to find book by author.
     * **/
    public function findByAuthor(string $author): Book|null
    {
        $bookData = BookModel::where('bookname', $author)->first();
        if (!$bookData) {
            return null;
        }
        return new Book(
            $bookData->id,
            $bookData->bookID,
            $bookData->bookname,
            $bookData->bookdetails,
            $bookData->author,
            $bookData->stock,
            $bookData->category,
            $bookData->datepublish,
            $bookData->image,
            $bookData->price,
            $bookData->createdAt,
            $bookData->updatedAt,
        );
    }
}
