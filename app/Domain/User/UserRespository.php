<?php

namespace App\Domain\User;

interface UserRespository
{
    public function authUser(string $email, string $password): ?User;

    public function logout(): void;

    public function create(User $user): void;

    public function update(User $user): void;

    public function findById(int $id): ?User;

    public function findByUserID(string $userID): ?User;

    public function findAll(): array;

    public function findAllPaginated(int $perPage);

    public function updateUserPassword(string $userID, string $password): void;

    public function getUserActivity(): array;

    public function getTotalUsers(): int;

    public function getTotalAdmins(): int;

    public function getTotalNewThisMonth(): int;

    public function searchUsers(string $query, int $perPage);

    public function deleteUser(string $userID): void;
}
