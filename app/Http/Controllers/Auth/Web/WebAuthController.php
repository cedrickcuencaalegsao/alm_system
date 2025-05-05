<?php

namespace App\Http\Controllers\Auth\Web;

use App\Application\User\RegisterUser;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebAuthController extends Controller
{
    private RegisterUser $registerUser;

    public function __construct(RegisterUser $registerUser)
    {
        $this->registerUser = $registerUser;
    }

    public function viewLogin()
    {
        return view('Page.Auth.Auth');
    }

    public function validateLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }
        if ($credentials = $request->only('email', 'password')) {
            $this->registerUser->authUser($request->email, $request->password);
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function viewRegister(): View
    {
        return view('Page.Auth.Register');
    }


    public function validateRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|string|max:255',
            'contactnumber' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }
        $userID = $this->generateUserID();
        $newUser = [
            'userID' => $userID,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'address' => $request->address,
            'contactNumber' => intval($request->contactnumber),
            'image' => 'default-profile.jpg',
            'password' => $request->password,
        ];
        $this->registerUser->create($newUser);

        return redirect()->route('login')->with('success', 'Registration successful. Please login to continue.');
    }

    /**
     * Fucntion to logout user session.
     * **/
    public function logout()
    {
        $this->registerUser->logout();

        return redirect()->route('login');
    }

    /**
     * Function to generate unique user ID.
     * **/
    public function generateUserID()
    {
        do {
            $prefix = 'USR';

            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            $randomPart = '';

            for ($i = 0; $i < 12; $i++) {
                $randomPart .= $characters[rand(0, strlen($characters) - 1)];
            }

            $userId = $prefix.$randomPart;

            $exists = $this->registerUser->findByUserID(encrypt($userId));
        } while ($exists !== null);

        return $userId;
    }
}
