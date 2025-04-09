<?php

namespace App\Infrastructure\Persistance\Eloquent\Book;

use Illuminate\Database\Eloquent\Model;
use App\Infrastructure\Persistance\Eloquent\Sales\SalesModel;

class BookModel extends Model
{
    protected $table = 'tbl_books';
    protected $fillable = [
        'bookID',
        'bookname',
        'bookdetails',
        'author',
        'stock',
        'category',
        'datepublish',
        'image',
        'price',
    ];

    /**
     * Create a relationship with the SalesModel.
     **/
    public function sales(){
        return $this->hasMany(SalesModel::class, 'bookID', 'bookID');
    }
}
