<?php

namespace App\Application\User;

use App\Domain\User\UserRespository;
use App\Domain\User\User;
use Carbon\Carbon;

class RegisterUser
{
    private UserRespository $userRespository;

    public function __construct(UserRespository $userRespository)
    {
        $this->userRespository = $userRespository;
    }
    public function create($newUser)
    {
        $data = new User(
            null,
            $newUser['userID'],
            $newUser['isAdmin'],
            $newUser['firstname'],
            $newUser['lastname'],
            $newUser['address'],
            $newUser['contactNumber'],
            $newUser['image'],
            $newUser['email'],
            Carbon::now()->toDateTimeString(),
            Carbon::now()->toDateTimeString(),
        );
        return $this->userRespository->create($data);
    }
}
