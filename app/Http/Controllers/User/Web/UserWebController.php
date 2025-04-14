<?php

namespace App\Http\Controllers\User\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Application\User;
use App\Application\User\RegisterUser;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;

class UserWebController extends Controller
{
    private RegisterUser $registerUser;

    public function __construct(RegisterUser $registerUser)
    {
        $this->registerUser = $registerUser;
    }

    /**
     * Function to create new user.
     * **/
    public function register(Request $request): void
    {
        // $validate = Validator::make([]);
        // $data = $request->all();
        // return $this->registerUser->create();
    }
    /**
     * Function to generate 15digits userID;
     * **/
    public function generateNewUserID(): string
    {
        return '';
    }
    /**
     * Function to validate the new userID.
     * **/
    public function validateNewUserID(): bool
    {
        return true;
    }
    /**
     * View index page for auth.
     * **/
    public function index(): View
    {
        return view('Page.Profile.profile');
    }
}
