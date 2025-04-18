<?php

namespace App\Http\Controllers\User\Web;

use App\Application\User\RegisterUser;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserWebController extends Controller
{
    private RegisterUser $registerUser;

    public function __construct(RegisterUser $registerUser)
    {
        $this->registerUser = $registerUser;
    }

    public function updateProfile(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destinationPath = 'assets/images/users';
            $profileImage = date('YmdHis').'.'.$image->getClientOriginalExtension();
            $image->move(public_path($destinationPath), $profileImage);
            $this->updateUser($request->all(), $user->isAdmin, $profileImage);
        } else {
            $this->updateUser($request->all(), $user->isAdmin, null);
        }


        if ($request->filled('new_password')) {
            if (! password_verify($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }

            $this->registerUser->updateUserPassword($user->userID, $request->new_password);
        }

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function updateUser($user,$accountType, $image)
    {
        $updateUser = [
            'userID' => $user['userID'],
            'isAdmin' => $accountType,
            'firstname' => $user['first_name'],
            'lastname' => $user['last_name'],
            'address' => $user['address'],
            'contactNumber' => $user['phone'],
            'email' => $user['email'],
            'image' => $image,
        ];
        $this->registerUser->update($updateUser);
    }

    /**
     * View index page for auth.
     * **/
    public function index(string $userID): View
    {
        $userData = $this->registerUser->findByUserID($userID);

        return view('Page.Profile.profile', compact('userData'));
    }
}
