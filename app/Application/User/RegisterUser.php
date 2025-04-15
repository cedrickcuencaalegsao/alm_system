<?php

namespace App\Application\User;

use App\Domain\User\User;
use App\Domain\User\UserRespository;

class RegisterUser
{
    private UserRespository $userRespository;

    public function __construct(UserRespository $userRespository)
    {
        $this->userRespository = $userRespository;
    }

    public function authUser(string $email, string $password): ?User
    {
        return $this->userRespository->authUser($email, $password);
    }

    public function logout(): void
    {
        $this->userRespository->logout();
    }

    public function create($newUser)
    {
        $data = new User(
            null,
            $newUser['userID'],
            false,
            $newUser['firstname'],
            $newUser['lastname'],
            $newUser['address'],
            $newUser['contactNumber'],
            $newUser['image'],
            $newUser['email'],
            $newUser['password'],
            null,
            null,
        );

        return $this->userRespository->create($data);
    }

    public function findByUserID(string $userID): ?User
    {
        return $this->userRespository->findByUserID($userID);
    }

    public function findAll(): array
    {
        return $this->userRespository->findAll();
    }
}
