<?php

namespace App\Infrastructure\Persistance\Eloquent\User;

use App\Domain\User\User;
use App\Domain\User\UserRespository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class EloquentUserRepository implements UserRespository
{
    /**
     * Function to create new user.
     * **/
    public function create(User $user): void
    {
        $newUser = new UserModel;
        $newUser->userID = $user->getUserID();
        $newUser->isAdmin = $user->getIsAdmin();
        $newUser->firstname = $user->getFirstName();
        $newUser->lastname = $user->getLastName();
        $newUser->address = $user->getAddress();
        $newUser->contactnumber = $user->getContactNumber();
        $newUser->image = $user->getImage();
        $newUser->email = $user->getEmail();
        $newUser->isDeleted = false;
        $newUser->password = Hash::make($user->getPassword());
        $newUser->created_at = Carbon::now()->toDateTimeString();
        $newUser->updated_at = Carbon::now()->toDateTimeString();
        $newUser->save();
    }

    /**
     * Function to update the user data.
     * **/
    public function update(User $user): void
    {
        $newUserData = UserModel::where('userID', $user->getUserID())->first();

        $newUserData->userID = $user->getUserID();
        $newUserData->isAdmin = $user->getIsAdmin();
        $newUserData->firstname = $user->getFirstName();
        $newUserData->lastname = $user->getLastName();
        $newUserData->address = $user->getAddress();
        $newUserData->contactnumber = $user->getContactNumber();
        $newUserData->image = $user->getImage();
        $newUserData->email = $user->getEmail();
        $newUserData->updated_at = Carbon::now()->toDateTimeString();
        $newUserData->save();
    }

    /**
     * Function to update the user password.
     * **/
    public function updateUserPassword(string $userID, string $password): void
    {
        $user = UserModel::where('userID', $userID)->first();
        $user->password = Hash::make($password);
        $user->updated_at = Carbon::now()->toDateTimeString();
        $user->save();
    }

    /**
     * Funtion to get a user data by id.
     * **/
    public function findById(int $id): ?User
    {
        $user = UserModel::find($id);
        if (! $user) {
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
            $user->password,
            $user->isDeleted,
            $user->createdAt,
            $user->updatedAt,
        );
    }

    /**
     * Fucntion to get user data by userID.
     * **/
    public function findByUserID(string $userID): ?User
    {
        $userID = decrypt($userID);
        $user = UserModel::where('userID', $userID)->first();
        if (! $user) {
            return null;
        }

        return new User(
            $user->id,
            $user->userID,
            $user->isAdmin,
            $user->firstname,
            $user->lastname,
            $user->address,
            $user->contactnumber,
            $user->image,
            $user->email,
            $user->password,
            $user->isDeleted,
            $user->created_at,
            $user->updated_at,
        );
    }

    /**
     * Function to get all data from the table user.
     * **/
    public function findAll(): array
    {
        return UserModel::all()->map(fn ($user) => new User(
            id: $user->id,
            userID: $user->userID,
            isAdmin: $user->isAdmin,
            firstname: $user->firstname,
            lastname: $user->lastname,
            address: $user->address,
            contactNumber: $user->contactnumber,
            image: $user->image,
            email: $user->email,
            password: $user->password,
            isDeleted: $user->isDeleted,
            createdAt: $user->created_at,
            updatedAt: $user->updated_at,
        ))->toArray();
    }

    /**
     * Function to get paginated data from the table user.
     * **/
    public function findAllPaginated(int $perPage)
    {
        $users = UserModel::where('isDeleted', false)->paginate($perPage);

        $users->getCollection()->transform(function ($user) {
            return new User(
                id: $user->id,
                userID: $user->userID,
                isAdmin: $user->isAdmin,
                firstname: $user->firstname,
                lastname: $user->lastname,
                address: $user->address,
                contactNumber: $user->contactnumber,
                image: $user->image,
                email: $user->email,
                createdAt: $user->created_at,
                updatedAt: $user->updated_at,
                isDeleted: $user->isDeleted,
            );
        });

        return $users;
    }

    /**
     * Function to get the authenticated user.
     * **/
    public function authUser(string $email, string $password): ?User
    {
        $credentials = [
            'email' => $email,
            'password' => $password,
        ];
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // dd($user);
            return new User(
                $user->id,
                $user->userID,
                $user->isAdmin,
                $user->firstname,
                $user->lastname,
                $user->address,
                $user->contactnumber,
                $user->image,
                $user->email,
                $user->password,
                $user->isDeleted,
                $user->created_at,
                $user->updated_at,
            );
        }

        return null;
    }

    /**
     * Function to logout the user.
     * **/
    public function logout(): void
    {
        Session::flush();
        Auth::logout();
    }

    /**
     * Function to get the user activity.
     * **/
    public function getUserActivity(): array
    {
        $userActivity = UserModel::where('isDeleted', false)->get();
        $countActive = $userActivity->count();
        $countInactive = UserModel::where('isDeleted', true)->count();
        $totalUsers = $countActive + $countInactive;

        $percentage = ($countInactive / $totalUsers) * 100;
        $formattedPercentage = number_format($percentage, 2);

        return [
            'totalUsers' => $totalUsers,
            'percentage' => $formattedPercentage,
        ];
    }

    public function getTotalUsers(): int
    {
        return UserModel::count();
    }

    public function getTotalAdmins(): int
    {
        return UserModel::where('isAdmin', true)->count();
    }

    public function getTotalNewThisMonth(): int
    {
        return UserModel::where('created_at', '>=', Carbon::now()->startOfMonth()->toDateTimeString())->count();
    }

    /**
     * Function to search users by name or email
     * **/
    public function searchUsers(string $query, int $perPage)
    {
        $users = UserModel::where('isDeleted', false)
            ->where(function ($q) use ($query) {
                $q->where('firstname', 'LIKE', "%{$query}%")
                    ->orWhere('lastname', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%")
                    ->orWhere('userID', 'LIKE', "%{$query}%");
            })
            ->paginate($perPage);

        $users->getCollection()->transform(function ($user) {
            return new User(
                id: $user->id,
                userID: $user->userID,
                isAdmin: $user->isAdmin,
                firstname: $user->firstname,
                lastname: $user->lastname,
                address: $user->address,
                contactNumber: $user->contactnumber,
                image: $user->image,
                email: $user->email,
                createdAt: $user->created_at,
                updatedAt: $user->updated_at,
                isDeleted: $user->isDeleted,
            );
        });

        return $users;
    }

    public function deleteUser(string $userID): void
    {
        $user = UserModel::where('userID', $userID)->first();
        $user->isDeleted = true;
        $user->updated_at = Carbon::now()->toDateTimeString();
        $user->save();
    }
}
