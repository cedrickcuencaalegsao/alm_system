<?php

namespace App\Infrastructure\Persistance\Eloquent\Cart;

use Illuminate\Database\Eloquent\Model;
use App\Infrastructure\Persistance\Eloquent\Book\BookModel;
class CartModel extends Model
{
    protected $table = 'tbl_cart';

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
