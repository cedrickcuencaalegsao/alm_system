<?php

namespace App\Domain\User;

interface UserRespository
{
    public function authUser(): ?User;
    public function create(User $user): void;
    public function update(User $user): void;
    public function findById(int $id): ?User;
    public function findByUserID(string $userID): ?User;
    public function findAll(): array;
}
