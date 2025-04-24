<?php

namespace App\Http\Controllers\ManageUser\WEB;

use App\Application\User\RegisterUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManageUserWEBController extends Controller
{
    private $registerUser;

    public function __construct(RegisterUser $registerUser)
    {
        $this->registerUser = $registerUser;
    }

    public function index(Request $request)
    {
        $stats = [
            'totalUsers' => $this->registerUser->getTotalUsers(),
            'totalAdmins' => $this->registerUser->getTotalAdmins(),
            'totalNewThisMonth' => $this->registerUser->getTotalNewThisMonth(),
        ];

        $search = $request->input('search');

        if ($search) {
            $users = $this->registerUser->searchUsers($search, 5);
        } else {
            $users = $this->registerUser->findAllPaginated(5);
        }

        return view('Page.ManageUser.manageuser', compact('stats', 'users', 'search'));
    }

    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|string|max:255',
            'contactnumber' => 'required|numeric|digits:11',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }
        if ($request->password !== $request->password_confirmation) {
            return redirect()
                ->back()
                ->withErrors(['password' => 'Passwords do not match'])
                ->withInput($request->except('password'));
        }
        $data = $request->all();
        $data['image'] = null;
        $data['userID'] = $this->generateUserID();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destinationPath = 'assets/images/users';
            $imageName = date('YmdHis').'.'.$image->getClientOriginalExtension();

            $image->move(public_path($destinationPath), $imageName);
            $data['image'] = $imageName;
            $this->saveUser($data);

        } else {
            $this->saveUser($data);
        }

        return redirect()->route('view.manage.user')->with('success', 'User created successfully');
    }

    public function saveUser($data)
    {
        $newUser = [
            'userID' => $data['userID'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'address' => $data['address'],
            'contactNumber' => $data['contactnumber'],
            'email' => $data['email'],
            'password' => $data['password'],
            'image' => $data['image'],
        ];
        $this->registerUser->create($newUser);
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

    public function adminCreateUser()
    {
        return view('Page.AdminCreateUser.admincreateuser');
    }
}
