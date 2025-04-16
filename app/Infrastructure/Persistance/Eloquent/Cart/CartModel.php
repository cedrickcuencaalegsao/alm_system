<?php

namespace App\Infrastructure\Persistance\Eloquent\Cart;

use App\Infrastructure\Persistance\Eloquent\Book\BookModel;
use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    protected $table = 'tbl_cart';

    public $timestamps = false;

    protected $fillable = [
        'cartID',
        'userID',
        'bookID',
        'createdAt',
        'updatedAt',
    ];

    public function book()
    {
        return $this->belongsTo(BookModel::class, 'bookID', 'bookID');
    }
}
