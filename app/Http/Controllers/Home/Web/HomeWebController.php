<?php

namespace App\Http\Controllers\Home\Web;

use App\Application\Book\RegisterBook;
use App\Http\Controllers\Controller;
use App\Infrastructure\Persistance\Eloquent\Book\BookModel;
use Illuminate\Http\JsonResponse;

class HomeWebController extends Controller
{
    private RegisterBook $registerBook;

    public function __construct(RegisterBook $registerBook)
    {
        $this->registerBook = $registerBook;
    }

    public function index()
    {
        $books = collect($this->registerBook->findAll());
        // dd($books);

        return view('Page.home.home', compact('books'));
    }

    private function getCategories($books)
    {
        return $books->groupBy(function ($book) {
            return $book->getCategory();
        })->map(function ($group) {
            return $group->count();
        })->toArray();
    }

    /**
     * Get top 8 bestselling books
     */
    public function getBestSellingBooks(): JsonResponse
    {
        // Get top 8 bestselling books
        $bestSellingBooks = BookModel::select('tbl_books.*')
            ->leftJoin('tbl_sales', 'tbl_books.bookID', '=', 'tbl_sales.bookID')
            ->selectRaw('SUM(tbl_sales.quantity) as totalSold')
            ->where('tbl_books.isDeleted', false)
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
            ->map(fn ($book) => [
                'id' => $book->id,
                'bookID' => $book->bookID,
                'bookname' => $book->bookname,
                'bookdetails' => $book->bookdetails,
                'author' => $book->author,
                'stock' => $book->stocks,
                'category' => $book->bookcategory,
                'datepublish' => $book->datepublish,
                'image' => $book->image,
                'price' => $book->bookprice,
                'totalSold' => $book->totalSold ?? 0,
            ]);

        return response()->json([
            'success' => true,
            'data' => $bestSellingBooks,
        ]);
    }
}
