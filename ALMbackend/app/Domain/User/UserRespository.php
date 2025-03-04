<?php

namespace App\Domain\User;

interface UserRespository
{
    public function create(User $user);
    public function update(User $user);
    public function findById(User $user): array;
    public function findAll(): array;
}
