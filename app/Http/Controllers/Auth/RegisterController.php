<?php

namespace App\Http\Controllers\Auth;


use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\contact;
use Auth;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;


class RegisterController extends Controller
{
   /*
   |--------------------------------------------------------------------------
   | Register Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles the registration of new users as well as their
   | validation and creation. By default this controller uses a trait to
   | provide this functionality without requiring any additional code.
   |
   */

   use RegistersUsers;

   /**
    * Where to redirect users after login / registration.
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
       $this->middleware('guest');
   }

   /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
   protected function validator(array $data)
   {
       return Validator::make($data, [
           'name' => 'required|max:255',
           'email' => 'required|email|max:255|unique:users',
           'password' => 'required|min:6|confirmed',
           ]);
   }
   public function confirm($token){
       $users = DB::table('users')->get();
       foreach($users as $user){
           if(hash('ripemd160',$user->name)== $token){
               DB::table('users')->where('id', $user->id)->update(['confirmed'=>1]);

               Session::flash('message', 'Votre compte à bien été activé');
               Session::flash('alert-class', 'alert-success');
               return redirect('/login');
           }
       }
   }
   
   //check lien correspondance

   /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return User
    */
   protected function create(array $data)
   {
      $data["password"] = bcrypt($data['password']);
      $data["password_confirmation"] = bcrypt($data['password']);
      Mail::to($data["email"])->send(new contact($data));
      return User::create([
       'name' => $data['name'],
       'email' => $data['email'],
       'password' =>$data['password'],
       ]);
  }
  public function register(Request $request)
  {
      $validator = $this->validator($request->all());

      if ($validator->fails()) {
          $this->throwValidationException(
              $request, $validator
              );
      }

      $this->create($request->all());

  return redirect("/home"); // Change this route to your needs
}
}