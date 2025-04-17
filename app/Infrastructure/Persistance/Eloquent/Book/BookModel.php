<?php

namespace App\Infrastructure\Persistance\Eloquent\Book;

use App\Infrastructure\Persistance\Eloquent\Sales\SalesModel;
use Illuminate\Database\Eloquent\Model;

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

    const CREATED_AT = 'createdAt';

    const UPDATED_AT = 'updatedAt';

    /**
     * Create a relationship with the SalesModel.
     **/
    public function sales()
    {
        return $this->hasMany(SalesModel::class, 'bookID', 'bookID');
    }
}
