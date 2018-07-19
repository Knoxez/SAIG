<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use PDF;
use App\User;
use App\Institute;
use App\Menu;

class MenuController extends Controller
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
        return view('admin.comida')
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
        $user = User::find(auth()->user()->id);
        $inst = $user->institute;
        $inst_id = $inst->id;

        $rules = [
            'title' =>  'required',
            'fecha_ini' =>  'required|date',
            'fecha_fin' =>  'required|date',
            'monday'    =>  'required',
            'thuesday'  =>  'required',
            'wednesday' =>  'required',
            'thursday'  =>  'required',
            'friday'    =>  'required'
        ];

        $msg = [
            'title.required'    =>  'El título es necesario para identificar el menú de comida',
            'fecha_ini' =>  'La fecha inicio del menú de comida es necesario',
            'fecha_ini.date'    =>  'La fecha inicio debe tener un formato de fecha',
            'fecha_fin' =>  'La fecha fin es necesaria para el menú de comida',
            'fecha_fin.date'    =>  'La fecha fin debe de tener un formato de fecha',
            'moday.required'    =>  'Especifíca el menú del Lunes',
            'thuesday.required' =>  'Especifíca el menú del Martes',
            'wednesday.required'    =>  'Especifíca el menú del Miércoles',
            'thursday.required' =>  'Especifíca el menú del Jueves',
            'friday.required'   =>  'Especifíca el menú del Viernes'
        ];

        $this->validate($request, $rules, $msg);

        $comida = Menu::create([
            'title' =>  $request['title'],
            'fecha_ini' =>  $request['fecha_ini'],
            'fecha_fin' =>  $request['fecha_fin'],
            'monday'    =>  $request['monday'],
            'thuesday'  =>  $request['thuesday'],
            'wednesday' =>  $request['wednesday'],
            'thursday'  =>  $request['thursday'],
            'friday'    =>  $request['friday'],
            'institute_id'  => $inst_id
        ]);

        if ($request->ajax()) {
            return $message = "El menú de comida se ha guardado.";
        }
        return response()->json($comida);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comida = Menu::find($id);
        return $comida;
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
        $comida = Menu::find($id);

        $rules = [
            'title' =>  'required',
            'fecha_ini' =>  'required|date',
            'fecha_fin' =>  'required|date',
            'monday'    =>  'required',
            'thuesday'  =>  'required',
            'wednesday' =>  'required',
            'thursday'  =>  'required',
            'friday'    =>  'required'
        ];

        $msg = [
            'title.required'    =>  'El título es necesario para identificar el menú de comida',
            'fecha_ini' =>  'La fecha inicio del menú de comida es necesario',
            'fecha_ini.date'    =>  'La fecha inicio debe tener un formato de fecha',
            'fecha_fin' =>  'La fecha fin es necesaria para el menú de comida',
            'fecha_fin.date'    =>  'La fecha fin debe de tener un formato de fecha',
            'moday.required'    =>  'Especifíca el menú del Lunes',
            'thuesday.required' =>  'Especifíca el menú del Martes',
            'wednesday.required'    =>  'Especifíca el menú del Miércoles',
            'thursday.required' =>  'Especifíca el menú del Jueves',
            'friday.required'   =>  'Especifíca el menú del Viernes'
        ];

        $this->validate($request, $rules, $msg);

        $comida->title  =   $request['title'];
        $comida->fecha_ini  =   $request['fecha_ini'];
        $comida->fecha_fin  =   $request['fecha_fin'];
        $comida->monday =   $request['monday'];
        $comida->thuesday   =   $request['thuesday'];
        $comida->wednesday  =   $request['wednesday'];
        $comida->thursday   =   $request['thursday'];
        $comida->friday =   $request['friday'];

        if ($request->ajax()) {
            $comida->save();
            return $message = "El menú de comida se ha actualizado";
        }
        return response()->json($comida);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $comida = Menu::find($id);

        if ($request->ajax()) {
            $comida->delete();
            return $message = "El menú de comida se ha eliminado";
        }
        return response()->json($comida);
    }

    public function TableComida()
    {
        $user = User::find(Auth::User()->id);
        $inst = $user->institute;
        return datatables()->of(DB::table('menus')
            ->where('institute_id', '=', $inst->id)
            ->get())->toJson();
    }

    public function PDF($id)
    {
        $comida = Menu::find($id);
        $pdf = PDF::loadview('admin.PDF', ['comida' =>  $comida]);
        return $pdf->download($comida->title.'_'.time().'.pdf');
    }
}
