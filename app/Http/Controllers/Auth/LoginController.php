<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Session;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function authenticated(Request $request, $user){
        if($user['attributes']['confirmed'] == 0){
            Auth::logout();
        }
        else{

            Session::set('id', $user["attributes"]["id"]);
            Session::set('name', $user["attributes"]["name"]);
            Session::set('email', $user["attributes"]["email"]);
        }
        if (!file_exists(public_path("upload") . "/" . Session::get("id"))) {
            mkdir(public_path("upload") . "/" . Session::get("id"));
        }
    }
}
