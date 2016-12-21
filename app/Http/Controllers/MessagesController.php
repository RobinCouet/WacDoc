<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use Auth;

class MessagesController extends Controller
{
   public function index()
   {
       $users = DB::table('users')->get();
       return view('messages.index', ["membres" => $users]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
       DB::table('messages')->insert([
           'userfrom' => Session::get("id"),
           'userto' => $_POST['user'],
           'message' => $_POST["message"]
           ]);
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
       $messages = DB::table('messages')
       ->where("userfrom" , $id)
       ->where("userto", Session::get("id"))
       ->orwhere("userto", $id)
       ->where("userfrom", Session::get("id"))
       ->get();
       foreach ($messages as $message) {
           $message->userfrom = DB::table('users')->where("id", $message->userfrom)->get()[0]->name;
           $message->userto = DB::table('users')->where("id", $message->userto)->get()[0]->name;
       }
       return view("messages.show", ["messages" => $messages]);
   }
   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
       //
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
       //
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
       //
   }
}