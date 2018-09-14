<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function getDashboard()
    {
        return view('dashboard');
    }

    public function postSignIn(Request $request)
    {
        if(Auth::attempt(
            [
                'email'=> $request['email'],
                'password' => $request['password']
            ]
            )) {
            return redirect()->route('dashboard');
        }
        return redirect()->back();
    }

    public function postSignUp(Request $request)
    {
        $email      = $request['email'];
        $name       = $request['name'];
        $password   = bcrypt($request['password']);

        $user           = new User();
        $user->email    = $email;
        $user->name     = $name;
        $user->password = $password;

        $user->save();

        Auth::login($user);

        // return redirect()->back();
        return redirect()->route('dashboard');
    }

}