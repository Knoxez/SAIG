<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use App\User;
use App\Institute;
use App\Method;

use Illuminate\Http\Request;

class MethodController extends Controller
{
    public function __contruct()
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
        return view('admin.metodos')
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
        $user_id = Auth::User()->id;
        $user = User::find($user_id);
        $inst = $user->institute;

        $rules = [
            'name' =>   'required',
            'content'   =>  'required'
        ];

        $msg = [
            'name.required' =>  'Debe tener un nombre el método',
            'content.required'   =>  'Debes explicar de que trata el método'
        ];

        $this->validate($request, $rules, $msg);

        $metodo = Method::create([
            'method_name'   =>  $request->name,
            'content'   =>  $request->content
        ]);

        if ($request->ajax()) {
            $inst->methods()->sync($metodo);
            return $message = "Se ha guardado el método ".$metodo->method_name;
        }
        return response()-json($metodo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $metodo = Method::find($id);
        return $metodo;
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
        $metodo = Method::find($id);
        $user_id = Auth::User()->id;
        $user = User::find($user_id);
        $inst = $user->institute;

        $rules = [
            'name'  =>  'required',
            'content'   =>  'required'
        ];

        $msg = [
            'name.required' =>  'El nombre del método es necesario',
            'content.required'  =>  'La descripcción del método es necesaria'
        ];

        $this->validate($request, $rules, $msg);

        $metodo->method_name    =   $request['name'];
        $metodo->content    =   $request['content'];

        if ($request->ajax()) {
            $metodo->save();
            $metodo->institutes()->sync($inst->id);
            return $message = "El método se ha actualizado";
        }
        return response()->json($metodo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $metodo = Method::find($id);

        if ($request->ajax()) {
            $metodo->institutes()->detach();
            $metodo->delete();
            return $message = "El methodo ha sido eliminado";
        }
        return response()->json($metodo);
    }

    public function TableMethod()
    {
        $user = User::find(Auth::User()->id);
        $inst = $user->institute;
        return datatables()->of(DB::table('institute_method')
            ->join('methods', 'institute_method.method_id', '=', 'methods.id')
            ->where('institute_method.institute_id', '=', $inst->id)
            ->get())->toJson();
    }
}
