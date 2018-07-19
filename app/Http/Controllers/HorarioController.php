<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Group;
use App\Schedule;
use DB;

class HorarioController extends Controller
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
        return view('admin.horario')
            ->with('user', $user)
            ->with('inst', $inst)
            ->with('image', $image);
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
        $rules = [
            'name' => 'required',
            'group' => 'required'
        ];

        $msg = [
            'name.required' => 'El horario debe tener un nombre representativo',
            'group.required' => 'Necesitasa seleccionar un grupo'
        ];

        $credentials = $this->validate($request, $rules, $msg);

        // File
        $group = Group::find($request->group);
        $file = $request->file('doc');
        $extension = $request->file('doc')->getClientOriginalExtension();
        $school = Auth::User()->username;
        $name = str_replace(" ", "_", $request->name);
        $file_name = $name.'_'.date('d_m_y').'.'.$extension;
        $carpeta = public_path()."\\horarios\\".$school."\\".$group->group_name;
        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
        }
        $path = $carpeta;
        $file->move($carpeta, $file_name);

        $data = [
            'schedule_name' => $request['name'],
            'file'  =>  $file_name,
            'group_id'  =>  $request['group']
        ];

        if ($request->ajax()) {
            Schedule::Create($data);
            return $message = "EL horario se ha guardado";
        }
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

    public function TableHorario()
    {
        $user = User::find(Auth::User()->id);
        $inst_id = $user->institute->id;
        $group_id = DB::table('group_institute as gi')
            ->select('gi.group_id')
            ->where('gi.institute_id', '=', $inst_id)
            ->get()->toArray();
        foreach ($group_id as $groups) {
            $id[] = $groups->group_id;
        }
        // dd($id);
        return dataTables()->of(DB::table('schedules AS s')
            ->select(DB::raw('s.id, s.schedule_name, s.file, (select g.group_name from saig.groups AS g where g.id = s.group_id) as grupo'))
            ->whereIn('s.group_id', $id)
            ->get())->toJson();
    }

    public function HorarioDownload($id)
    {
        $archivo = Schedule::find($id);
        $group = Group::find($archivo->group_id);
        $school = Auth::User()->username;
        $file = $archivo->file;
        $url = public_path().'\\horarios\\'.$school.'\\'.$group->group_name.'\\'.$file;

        if (file_exists($url)) {
            return response()->download($url);
        }
        return abort(404);
    }
}
