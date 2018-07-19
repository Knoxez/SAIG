<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Institute;

class PerfilController extends Controller
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
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $inst = $user->institute;
        $image = $user->username."/".$inst->image;
        return view('admin.perfil')
            ->with('user', $user)
            ->with('inst', $inst)
            ->with('image', $image);
    }

    public function create()
    {
        $user_id = Auth::User()->id;
        $user = User::find($user_id);
        $inst = $user->institute;

        $data['user'] = $user;
        $data['inst'] = $inst;

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
        $inst = Institute::find($id);

        $inst->address  =   $request['address'];
        $inst->phone    =   $request['phone'];
        $inst->history  =   $request['history'];
        $inst->mision   =   $request['mision'];
        $inst->vision   =   $request['vision'];

        if ($request->ajax()) {
            $inst->save();
            return $message = 'Se han actualizado tus datos.';
        }
        return response()->json($inst);
    }

    public function POSTimage(Request $request)
    {
        $this->validate($request, [
            'image'
        ]);

        $user_id = Auth::User()->institute_id;
        $inst = Institute::find($user_id);

        $file = $request->file('image');
        $extension = $request->file('image')->getClientOriginalExtension();
        $file_name = $inst->schoolkey.'_'.time().'.'.$extension;
        $school = Auth::User()->username;
        $path = public_path()."\\images\\".$school;
        $file->move($path, $file_name);
        $inst->image = $file_name;

        if ($request->ajax()) {
            $inst->save();
            $data['success'] = true;
            $data['path'] = $school.'\\'.$file_name;
            $data['message'] = "La Imagen se ha actualizado";
            return $data;
        }

        return response()->json($inst);

    }
}
