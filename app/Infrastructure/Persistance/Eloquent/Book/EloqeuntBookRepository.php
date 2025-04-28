<?php

namespace App\Infrastructure\Persistance\Eloquent\Book;

use App\Domain\Book\Book;
use App\Domain\Book\BookRepository;

class EloqeuntBookRepository implements BookRepository
{
    /**
     * Function to get book data by id.
     * **/
    public function findByID(int $id): ?Book
    {
        $bookData = BookModel::find($id);
        if (! $bookData) {
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
    public function findByBookID(string $bookID): ?Book
    {
        $bookData = BookModel::where('bookID', $bookID)->first();
        if (! $bookData) {
            return null;
        }

        return new Book(
            $bookData->id,
            $bookData->bookID,
            $bookData->bookname,
            $bookData->bookdetails,
            $bookData->author,
            $bookData->stocks,
            $bookData->bookcategory,
            $bookData->datepublish,
            $bookData->image,
            $bookData->bookprice,
            $bookData->isDeleted,
            $bookData->createdAt,
            $bookData->updatedAt,
        );
    }

    /**
     * Function to create a new book.
     * **/
    public function create(Book $book): void
    {
        $newBook = new BookModel;
        $newBook->bookID = $book->getBookID();
        $newBook->bookname = $book->getBookName();
        $newBook->bookdetails = $book->getBookDetails();
        $newBook->author = $book->getAuthor();
        $newBook->stocks = $book->getStock();
        $newBook->bookcategory = $book->getCategory();
        $newBook->datepublish = $book->getDatePublish();
        $newBook->image = $book->getImage();
        $newBook->bookprice = $book->getPrice();
        $newBook->isDeleted = $book->getIsDeleted();
        $newBook->createdAt = $book->createdAt();
        $newBook->updatedAt = $book->updatedAt();
        $newBook->save();
    }

    /**
     * Function to update book data.
     * **/
    public function update(Book $book): void
    {
        $newBookData = BookModel::where('bookID', $book->getBookID())->first() ?? new BookModel;
        $newBookData->bookID = $book->getBookID();
        $newBookData->bookname = $book->getBookName();
        $newBookData->bookdetails = $book->getBookDetails();
        $newBookData->author = $book->getAuthor();
        $newBookData->stocks = $book->getStock();
        $newBookData->bookcategory = $book->getCategory();
        $newBookData->datepublish = $book->getDatePublish();
        $newBookData->image = $book->getImage();
        $newBookData->bookprice = $book->getPrice();
        $newBookData->updatedAt = $book->updatedAt();
        $newBookData->save();
    }

    /**
     * Function to get best selling book.
     * **/
    public function getBestSellingBook(): array
    {
        $bestSelling = BookModel::select('tbl_books.*')
            ->leftJoin('tbl_sales', 'tbl_books.bookID', '=', 'tbl_sales.bookID')
            ->selectRaw('SUM(tbl_sales.quantity) as totalSold')
            ->where('tbl_books.stocks', '>', 0)
            ->groupBy('tbl_books.id',
                'tbl_books.bookID',
                'tbl_books.bookname',
                'tbl_books.bookdetails',
                'tbl_books.author',
                'tbl_books.stocks',
                'tbl_books.bookcategory',
                'tbl_books.datepublish',
                'tbl_books.image',
                'tbl_books.bookprice',
                'tbl_books.isDeleted',
                'tbl_books.createdAt',
                'tbl_books.updatedAt')
            ->orderByRaw('COALESCE(SUM(tbl_sales.quantity), 0) DESC')
            ->take(8)
            ->get()
            ->map(fn ($book) => new Book(
                id: $book->id,
                bookID: $book->bookID,
                bookname: $book->bookname,
                bookdetails: $book->bookdetails,
                author: $book->author,
                stock: $book->stocks,
                category: $book->bookcategory,
                datepublish: $book->datepublish,
                image: $book->image,
                price: $book->bookprice,
                createdAt: $book->createdAt,
                updatedAt: $book->updatedAt,
                totalSold: $book->totalSold,
            ))->toArray();

        return $bestSelling;
    }

    /**
     * Function to get top selling book.
     * **/
    public function getTopSellingBook(): array
    {
        return BookModel::select('tbl_books.*')
            ->leftJoin('tbl_sales', 'tbl_books.bookID', '=', 'tbl_sales.bookID')
            ->selectRaw('COALESCE(SUM(tbl_sales.quantity), 0) as totalSold')
            ->groupBy([
                'tbl_books.id',
                'tbl_books.bookID',
                'tbl_books.bookname',
                'tbl_books.bookdetails',
                'tbl_books.author',
                'tbl_books.stocks',
                'tbl_books.bookcategory',
                'tbl_books.datepublish',
                'tbl_books.image',
                'tbl_books.isDeleted',
                'tbl_books.bookprice',
                'tbl_books.createdAt',
                'tbl_books.updatedAt',
            ])
            ->orderByDesc('totalSold')
            ->take(5)
            ->get()
            ->map(fn ($book) => new Book(
                id: $book->id,
                bookID: $book->bookID,
                bookname: $book->bookname,
                bookdetails: $book->bookdetails,
                author: $book->author,
                stock: $book->stocks,
                category: $book->bookcategory,
                datepublish: $book->datepublish,
                image: $book->image,
                price: $book->bookprice,
                isDeleted: $book->isDeleted,
                createdAt: $book->createdAt,
                updatedAt: $book->updatedAt,
                totalSold: (int) $book->totalSold
            ))->toArray();
    }

    /**
     * Function to find all book data.
     * **/
    public function findAll(): array
    {

        $byCategory = BookModel::query()
            ->where('stocks', '>', 0)
            ->orderBy('bookcategory')
            ->get()
            ->groupBy('bookcategory')
            ->map(function ($bookCategory) {
                return $bookCategory->map(fn ($book) => new Book(
                    id: $book->id,
                    bookID: $book->bookID,
                    bookname: $book->bookname,
                    bookdetails: $book->bookdetails,
                    author: $book->author,
                    stock: $book->stocks,
                    category: $book->bookcategory,
                    datepublish: $book->datepublish,
                    image: $book->image,
                    price: $book->bookprice,
                    createdAt: $book->createdAt,
                    updatedAt: $book->updatedAt,
                ));
            })->toArray();

        $allBooks = BookModel::where('stocks', '>', 0)
            ->get()
            ->map(fn ($book) => new Book(
                id: $book->id,
                bookID: $book->bookID,
                bookname: $book->bookname,
                bookdetails: $book->bookdetails,
                author: $book->author,
                stock: $book->stocks,
                category: $book->bookcategory,
                datepublish: $book->datepublish,
                image: $book->image,
                price: $book->bookprice,
                createdAt: $book->createdAt,
                updatedAt: $book->updatedAt,
            ))->toArray();

        return [
            'allBooks' => $allBooks,
            'bestSelling' => $this->getBestSellingBook(),
            'byCategory' => $byCategory,
        ];
    }

    /**
     * Function to find book by name;
     **/
    public function findByName(string $bookname): ?Book
    {
        $bookData = BookModel::where('bookname', $bookname)->first();
        if (! $bookData) {
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
    public function findByAuthor(string $author): ?Book
    {
        $bookData = BookModel::where('bookname', $author)->first();
        if (! $bookData) {
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
     * Function to update stock when item is bought.
     * **/
    public function updateStockWhenItemBought(string $bookID, int $quantity): void
    {
        $bookData = BookModel::where('bookID', $bookID)->first();
        $bookData->stocks = $bookData->stocks - $quantity;
        $bookData->save();
    }

    public function search(string $searchTerm): array
    {
        $results = BookModel::where('bookname', 'like', "%$searchTerm%")
            ->orWhere('author', 'like', "%$searchTerm%")
            ->orWhere('bookcategory', 'like', "%$searchTerm%")
            ->orWhere('bookdetails', 'like', "%$searchTerm%")
            ->orWhere('bookprice', 'like', "%$searchTerm%")
            ->get();

        return $results->map(fn ($book) => new Book(
            $book->id,
            $book->bookID,
            $book->bookname,
            $book->bookdetails,
            $book->author,
            $book->stocks,
            $book->bookcategory,
            $book->datepublish,
            $book->image,
            $book->bookprice,
            $book->isDeleted,
            $book->createdAt,
            $book->updatedAt,
        ))->toArray();
    }

    public function getBooksInStockCount(): array
    {
        $booksInStock = BookModel::where('stocks', '>', 0)->count();
        $booksOutOfStock = BookModel::where('stocks', 0)->count();
        $totalBooks = $booksInStock + $booksOutOfStock;

        $percentage = ($booksOutOfStock / $totalBooks) * 100;
        $formattedPercentage = number_format($percentage, 2);

        return [
            'booksInStock' => $booksInStock,
            'percentage' => $formattedPercentage,
        ];
    }

    public function get5LowStockBooks(): array
    {
        $get5lowStockBooks = BookModel::where('stocks', '<=', 50)->orderBy('stocks', 'asc')->take(5)->get()->map(fn ($book) => new Book(
            $book->id,
            $book->bookID,
            $book->bookname,
            $book->bookdetails,
            $book->author,
            $book->stocks,
            $book->bookcategory,
            $book->datepublish,
            $book->image,
            $book->bookprice,
            $book->isDeleted,
            $book->createdAt,
            $book->updatedAt,
        ))->toArray();

        $totalLowStockBooks = BookModel::where('stocks', '<=', 50)->count();

        return [
            'get5lowStockBooks' => $get5lowStockBooks,
            'totalLowStockBooks' => $totalLowStockBooks,
        ];
    }

    public function restockBook(array $data): void
    {
        $bookData = BookModel::where('bookID', $data['bookID'])->first();
        $bookData->stocks = $bookData->stocks + $data['quantity'];
        $bookData->updatedAt = $data['updatedAt'];
        $bookData->save();
    }

    public function deleteBook(array $book){
        $bookData = BookModel::where('bookID', $book['bookID'])->first();
        $bookData->isDeleted = $book['isDeleted'];
        $bookData->updatedAt = $book['updatedAt'];
        $bookData->save();
    }
}
