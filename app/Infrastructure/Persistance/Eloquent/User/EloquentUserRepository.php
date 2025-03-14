<?php

namespace App\Infrastructure\Persistance\Eloquent\User;

use App\Domain\User\UserRespository;
use App\Domain\User\User;


class EloquentUserRepository implements UserRespository
{
    /**
     * Function to create new user.
     * **/
    public function create(User $user): void
    {
        $newUser = new UserModel();
        $newUser->userID = $user->getUserID();
        $newUser->isAdmin = $user->getIsAdmin();
        $newUser->fistname = $user->getFirstName();
        $newUser->lastname = $user->getLastName();
        $newUser->address = $user->getAddress();
        $newUser->contactnumber = $user->getContactNumber();
        $newUser->image = $user->getImage();
        $newUser->email = $user->getEmail();
        $newUser->createdAt = $user->createdAt();
        $newUser->updatedAt = $user->updatedAt();
        $newUser->save();
    }
    /**
     * Function to update the user data.
     * **/
    public function update(User $user): void
    {
        $newUserData = UserModel::find($user->getId()) ?? new UserModel();
        $newUserData->userID = $user->getUserID();
        $newUserData->isAdmin = $user->getIsAdmin();
        $newUserData->fistname = $user->getFirstName();
        $newUserData->lastname = $user->getLastName();
        $newUserData->address = $user->getAddress();
        $newUserData->contactnumber = $user->getContactNumber();
        $newUserData->image = $user->getImage();
        $newUserData->email = $user->getEmail();
        $newUserData->updatedAt = $user->updatedAt();
        $newUserData->save();
    }
    /**
     * Funtion to get a user data by id.
     * **/
    public function findById(int $id): ?User
    {
        $user = UserModel::find($id);
        if (!$user) {
            return null;
        }
        return new User(
            $user->id,
            $user->userID,
            $user->isAdmin,
            $user->firstname,
            $user->lastname,
            $user->address,
            $user->contactNumber,
            $user->image,
            $user->email,
            $user->createdAt,
            $user->updatedAt,
        );
    }
    /**
     * Fucntion to get user data by userID.
     * **/
    public function findByUserID(string $userID): ?User
    {
        $user = UserModel::where('userID', $userID)->first();
        if (!$user) {
            return null;
        }
        return new User(
            $user->id,
            $user->userID,
            $user->isAdmin,
            $user->firstname,
            $user->lastname,
            $user->address,
            $user->contactNumber,
            $user->image,
            $user->email,
            $user->createdAt,
            $user->updatedAt,
        );
    }
    /**
     * Function to get all data from the table user.
     * **/
    public function findAll(): array
    {
        return UserModel::all()->map(fn($user) => new User(
            id: $user->id,
            userID: $user->userID,
            isAdmin: $user->isAdmin,
            firstname: $user->firstname,
            lastname: $user->lastname,
            address: $user->address,
            contactNumber: $user->contactNumber,
            image: $user->image,
            email: $user->email,
            createdAt: $user->createdAt,
            updatedAt: $user->updatedAt,
        ))->toArray();
    }
}
