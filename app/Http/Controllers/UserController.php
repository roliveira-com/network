<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    /**
     * Desloga o usuário.
     *

     * @return view
     */
    public function logOut()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required',
            'password'  => 'required'
        ]);

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

        $this->validate($request, [
            'email'     => 'required|email|unique:users',
            'name'      => 'required',
            'password'  => 'required|min:4'
        ]);


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

    public function getProfile(){
        return view('profile',['user'=> Auth::user()]);
    }

    public function postSaveProfile(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
        ]);

        $user = Auth::user();
        $user->name = $request['name'];
        $user->update();

        $file = $request->file('image');
        $filename = $request['name'] . '-' . $user->id . '.jpg';

        if($file){
            Storage::disk('local')->put($filename, File::get($file));
        }
        return redirect()->route('profile');
    }

    public function getProfileImage($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

}