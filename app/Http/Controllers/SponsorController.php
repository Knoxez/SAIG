<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
use App\Institute;
use App\Sponsor;

class SponsorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::User()->id);
        $inst = $user->institute;
        $image = $user->username.'/'.$inst->image;
        return view('admin.patrocinadores')
            ->with('user', $user)
            ->with('inst', $inst)
            ->with('image', $image);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = User::find(Auth::User()->id);
        $inst = $user->institute;
        $rules = [
            'sponsor_name'  =>  'required|unique:sponsors',
            'image' =>  'required|mimes:png,jpg,jpeg|max:3072'
        ];

        $msg = [
            'sponsor_name.required' =>  'El nombre del patrocinador es requerido',
            'sponsor_name.unique'   =>  'Este patrocinador ya existe en nuestros registros',
            'image.reuired' =>  'La imagen es necesaria para identificar al patrocinador',
            'image.mimes'   =>  'La imagen no tiene el formato correcto',
            'image.max' =>  'La imagen no debe superar los 3MB'
        ];

        $this->validate($request, $rules, $msg);

        if ($request->hasFile('image')) {
            //imagen
            $file = $request->file('image');
            $extension = $request->file('image')->getClientOriginalExtension();
            $school = Auth::User()->username;
            $file_name = $request->sponsor_name.'_'.time().'.'.$extension;
            $carpeta = public_path()."\\images\\".$school."\\sponsors";
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }
            $path = $carpeta;
            $file->move($carpeta, $file_name);
        }

        $sponsor = new Sponsor;
        $sponsor->sponsor_name = $request['sponsor_name'];
        $sponsor->image = $file_name;

        if ($request->ajax()) {
            $sponsor->save();
            $sponsor->institutes()->sync($inst->id);
            return $message = 'El patrocinador se ha añadido';
        }
        return response()->json($sponsor);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sponsor = Sponsor::find($id);
        $data['id'] = $sponsor->id;
        $data['sponsor_name'] = $sponsor->sponsor_name;
        $data['image'] = '\\images\\'.Auth::User()->username.'\\sponsors\\'.$sponsor->image;
        $data['image_file'] = $sponsor->image;
        return $data;
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
        $sponsor = Sponsor::find($id);
        $user = User::find(Auth::User()->id);
        $inst = $user->institute;
        $rules = [
            'sponsor_name'  =>  'required',
            'image' =>  'image'
        ];

        $msg = [
            'sponsor_name.unique'   =>  'Ya existe este patrocinador en nuestros registros',
            'image.image'   =>  'El archivo debe ser una imagen'
        ];

        $this->validate($request, $rules, $msg);
        $school = Auth::User()->username;
        $carpeta = public_path()."\\images\\".$school."\\sponsors";

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $request->file('image')->getClientOriginalExtension();
            $name = str_replace(" ", "_", $request->sponsor_name);
            $file_name = $name.'_'.time().'.'.$extension;
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }
            $path = $carpeta;
            $file->move($carpeta, $file_name);
        } else {
            $ext = explode('.', $sponsor->image);
            $name = str_replace(" ", "_", $request->sponsor_name);
            $file_name = $name.'_'.time().'.'.$ext[1];
            rename($carpeta."/".$sponsor->image, $carpeta."/".$file_name);
        }

        $sponsor->sponsor_name  =   $request['sponsor_name'];
        $sponsor->image = $file_name;

        if ($request->ajax()) {
            $sponsor->save();
            $sponsor->institutes()->sync($inst->id);
            return $message = "El patrocinador se ha actualizado";
        }
        return response()->json($sponsor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $sponsor = Sponsor::find($id);

        if ($request->ajax()) {
            $sponsor->institutes()->detach();
            $sponsor->delete();
            return $message = "El patrocinador ha sido eliminado";
        }
        return response()->json($sponsor);
    }

    public function TableSponsor()
    {
        $user_id = Auth::User()->id;
        return dataTables()->of(DB::table('institute_sponsor')
            ->join('sponsors', 'institute_sponsor.sponsor_id', '=', 'sponsors.id')
            ->where('institute_sponsor.institute_id', '=', $user_id)
            ->get())->toJson();
    }
}
