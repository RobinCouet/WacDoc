<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;


class ShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $i = 0;
        $files = DB::table('share')
        ->where("userto" , Session::get("id"))
        ->get();
        foreach ($files as $file) {
            $share[$i] = DB::table('files')
            ->where('id', $file->id_file)->get()[0];
            $i++;
        }
        if (isset($share)) {
            return view('share.index', ["files" => $share]);
        }
        else {
            return view("share.index");
        }



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_file = $request->request->get('id');
        $my_id = Session::get("id");
        $user = DB::table('users')->where('email', $request->request->get('share'))->get();
        if (isset($user[0]->id)) {
            $id_user = $user[0]->id;
            DB::table('share')->insert(
                ['id_file' => $id_file, 'userfrom' => $my_id, 'userto' => $id_user]);
            Session::Flash("message", "Fichier bien partagé");
            Session::Flash("alert-class", 'alert-success');
            return redirect("/files");
        }
        else {
            Session::Flash("message", "L'email ne correspond pas");
            Session::Flash("alert-class", 'alert-danger');
            return redirect("/files");  
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $files = DB::table('files')
        ->where("id" , $id)
        ->get();

        return view('share.show', ["files" => $files]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $path = public_path();
        $files = DB::table('files')
        ->where('id', $id)
        ->get();
        if ($files[0]->type != "mywac") {
            Session::flash('message', 'Ce fichier ne peux être modifié!'); 
            Session::flash('alert-class', 'alert-danger'); 
            return redirect("/share");
        }
        $content = file_get_contents($path . "/upload/" . Session::get("id") . "/" . $files[0]->filename);
        return view('share.edit', array("content" => $content, "file" => $files[0]));
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
