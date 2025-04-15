<?php

namespace App\Infrastructure\Persistance\Eloquent\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';
    protected $fillable = [
        'userID',
        'isAdmin',
        'firstname',
        'lastname',
        'address',
        'contactnumber',
        'image',
        'email',
        'password',
        'created_at',
        'updated_at',
    ];
}
