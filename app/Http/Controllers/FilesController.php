<?php
namespace App\Http\Controllers;
require('fpdf.php');
use FPDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Redirect;
class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = DB::table('files')
        ->where("user_id" , Session::get("id"))
        ->get();
        return view('files.index', ["files" => $files]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(!empty($_POST)){

        // id de la session en cour
            $id = Session::get('id');

        // chemin vers le dossier upload du l'user authenticate
            $path = public_path() . "/upload/$id/";

        // stock le nom du fichier
            $file = $_POST['name'].'.mywac';

            if(!file_exists($path.$file)){

            // insere les donnée dans la bdd
                DB::table('files')->insert([
                    'size' => 0, 
                    'type' => 'mywac',
                    'filename' => $file,
                    'user_id' => $id,
                    'choices' => 'private'
                    ]);

                // crée le fichier .mywac
                touch($path.$file);
                $id_file = DB::getPdo()->lastInsertId();

                Session::flash('message','Création de votre fichier réussi ! Vous pouvez désormais l\'édité !');
                Session::flash('alert-class','alert-success');

                return redirect('/files/'. $id_file .'/edit/');
            }
        }
        return view('files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Session::get('id') != ""){

            // on recup l'id dans la session
            $id = Session::get('id');

            if($request->files->get('files')){

                foreach ($request->files->get('files') as $key => $value) {

                    $image = $request->files->get('files')[$key][$key];
                    $imageName = $image->getClientOriginalName();
                    if(!file_exists(public_path('upload') . '/' . Auth::user()->id . '/'.$imageName)){

                        $image->move(public_path('upload') . '/' . Auth::user()->id . '/',$imageName);
                        DB::table('files')->insert([
                            'size' => $image->getClientSize(), 
                            'type' => $image->getClientMimeType(),
                            'filename' => $image->getClientOriginalName(),
                            'user_id' => $id,
                            'choices' => 'private'
                            ]);
                    }
                }
            }/*else{

                if($_FILES['filess']['name'][0] != ''){

                // on recupere le chemin public, et on ajoute le chemin vers le dossier upload
                    $path = public_path() . "/upload/$id/";

                // on vérifi si le dossier existe déja
                    if(file_exists("/upload/$id/")){

                    }else{
                // on crée le dossier non recursif
                // mkdir($path, 0755, false);
                    }
                    $name = $_FILES['filess']['name'][0];
                    $tmp = $_FILES['filess']['tmp_name'][0];
                    $size = $_FILES['filess']['size'][0];
                    $type = $_FILES['filess']['type'][0];
                    
                    if(!file_exists($path.$name.'.'.$type)){

                        DB::table('files')->insert([
                            'size' => $size, 
                            'type' => $type,
                            'filename' => $name,
                            'user_id' => $id,
                            'choices' => 'private'
                            ]);
                        move_uploaded_file($_FILES['filess']['tmp_name'][0], $path.$name);

                        Session::flash('message','Upload réussi avec success !');
                        Session::flash('alert-class','alert-success');
                        return redirect('/');
                    }else{
                     Session::flash('message','Upload failed, le fichiers existe déja !');
                     Session::flash('alert-class','alert-danger');
                     return redirect('/');
                 }
             }else{
                Session::flash('message','Vous n\'avez mis aucun fichiers à upload !');
                Session::flash('alert-class','alert-danger');
                return redirect('/');
            }
        }*/
    }else{
        Session::flash('message','Vous ne pouvez pas uploadé de fichiers sans vous connecter !');
        Session::flash('alert-class','alert-danger');
        return redirect('/login');
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

        return view('files.show', ["files" => $files]);
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
            return redirect("/files");
        }
        $content = file_get_contents($path . "/upload/" . Session::get("id") . "/" . $files[0]->filename);
        return view('files.edit', array("content" => $content, "file" => $files[0]));

    }

    public function download($id, $type) {
        $file = DB::table("files")
        ->where('id', $id)
        ->get();
        $filename = $file[0]->filename;
        if ($type == "html") {
            header('Content-Type: text/html');
            header('Content-Disposition: attachment; filename="downloaded.html"');
            $file = public_path("upload") . "/" . Session::get("id") . "/" . $filename;
            readfile($file);
        }
        elseif ($type == "pdf") {
            $file = public_path("upload") . "/" . Session::get("id") . "/" . $filename;
            $content = file_get_contents($file);
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',16);
            $pdf->WriteHTML($content);
            $test = $pdf->Output();
            dd($test);
        }
        // return redirect("/files");
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
        $file = DB::table("files")
        ->where('id', $id)
        ->get();
        $filename = $file[0]->filename;
        file_put_contents(public_path("upload") . "/" . Session::get("id") . "/" . $filename, $request->request->get("textarea"));
        Session::flash('message', 'Vous avez bien modifié le fichier!'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect("/files");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $path = public_path();
        $files = DB::table('files')
        ->where('id', $id)
        ->get();
        unlink($path . "/upload/" . Session::get("id") . "/" . $files[0]->filename);
        DB::table('files')
        ->where('id', $id)
        ->delete();

        Session::flash('message', 'Votre fichier à bien été supprimé !'); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect("/files");
    }
}
