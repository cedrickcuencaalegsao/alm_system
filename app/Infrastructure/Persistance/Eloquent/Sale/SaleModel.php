<?php

namespace App\Infrastructure\Persistance\Eloquent\Sale;

use App\Infrastructure\Persistance\Eloquent\Book\BookModel;
use Illuminate\Database\Eloquent\Model;

class SaleModel extends Model
{
    protected $table = 'tbl_sales';

    protected $fillable = [
        'salesID',
        'bookID',
        'userID',
        'booksold',
        'totalsales',
        'createdAt',
        'updatedAt',
    ];

    // Set custom timestamp column names
    const CREATED_AT = 'createdAt';

    const UPDATED_AT = 'updatedAt';

    public function book()
    {
        return $this->belongsTo(BookModel::class, 'bookID', 'bookID');
    }
}
