<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Institute;
use App\Group;
use DB;

class GroupsController extends Controller
{
    public function __construc()
    {
        $this->middleware('Auth');
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
            'group_name'    =>  'required',
        ];

        $msg = [
            'group_name.required'   =>  'El nombre del grupo es obligatorio.'
        ];

        $this->validate($request, $rules, $msg);

        $group = Group::create([
            'group_name'    =>  $request['group_name'],
        ]);

        $group->institutes()->sync($inst->id);

        if ($request->ajax()) {
            return $message = "El grupo ".$request["group_name"]." se ha agregado.";
        }
        return response()->json($curso);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grupo = Group::find($id);
        return $grupo;
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
        $rules = [
            'group_name'    =>  'required'
        ];

        $msg = [
            'group_name.required'   =>  'El nombre del grupo es requerido'
        ];

        $this->validate($request, $rules, $msg);

        $group = Group::find($id);
        $group->group_name  =   $request['group_name'];

        if ($request->ajax()) {
            $group->save();
            return $message = 'El grupo se ha actualizado';
        }
        return response()->json($group);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $grupo = Group::find($id);

        if ($request->ajax()) {
            $grupo->delete();
            return $message = 'El grupo '.$grupo->group_name.' ha sido eliminado.';
        }
        return response()->json($grupo);
    }

    /**
    * Display a list of the table.
    *
    * @return \Illuminate\Http\Response
    */
    public function getList()
    {
        $user = User::find(Auth::User()->id);
        $inst_id = $user->institute->id;
        return datatables()->of(DB::table('group_institute AS gi')
            ->select('g.id', 'g.group_name')
            ->join('saig.groups AS g', 'gi.group_id', '=', 'g.id')
            ->where('gi.institute_id', '=', $inst_id)
            ->get())->toJson();
    }

    public function SelectGrupo()
    {
        $grupo = Group::all();
        $select = [];
        foreach ($grupo as $data) {
            $select[] = ["id" => $data->id, "text" => $data->group_name];
        }

        return response()->json($select);
    }
}
