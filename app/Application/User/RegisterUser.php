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

    public function update($user)
    {
        $data = new User(
            null,
            $user['userID'],
            $user['isAdmin'],
            $user['firstname'],
            $user['lastname'],
            $user['address'],
            $user['contactNumber'],
            $user['image'],
            $user['email'],
            null,
            null,
            null,
        );

        return $this->userRespository->update($data);
    }

    public function updateUserPassword(string $userID, string $password)
    {
        return $this->userRespository->updateUserPassword($userID, $password);
    }

    public function findByUserID(string $userID): ?User
    {
        return $this->userRespository->findByUserID($userID);
    }

    public function findAll(): array
    {
        return $this->userRespository->findAll();
    }

    public function findAllPaginated(int $perPage)
    {
        return $this->userRespository->findAllPaginated($perPage);
    }

    public function getUserActivity(): array
    {
        return $this->userRespository->getUserActivity();
    }

    public function getTotalUsers(): int
    {
        return $this->userRespository->getTotalUsers();
    }

    public function getTotalAdmins(): int
    {
        return $this->userRespository->getTotalAdmins();
    }

    public function getTotalNewThisMonth(): int
    {
        return $this->userRespository->getTotalNewThisMonth();
    }

    public function searchUsers(string $query, int $perPage)
    {
        return $this->userRespository->searchUsers($query, $perPage);
    }
}
