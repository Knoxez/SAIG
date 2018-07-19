<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Institute;
use App\Group;
use App\Course;
use DB;

class CursoController extends Controller
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
        return view('admin.curso')
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
            'name'   =>  'required',
            'hours'         =>  'required|max:12',
            'groups'        =>  'required',
            'description'   =>  'required'
        ];

        $msg = [
            'name.required'  =>  'El nombre del curso es requerido',
            'hours.required'        =>  'Las horas del curso son requeridas',
            'hours.max'             =>  'No se puede más de 12 hrs',
            'groups.required'       =>  'Los grupos son necesarios',
            'description.required'  =>  'La descripción es necesaria'
        ];

        $this->validate($request, $rules, $msg);

        $curso = Course::create([
            'course_name'   =>  $request['name'],
            'hours'         =>  $request['hours'],
            'description'   =>  $request['description']
        ]);

        if ($request->ajax()) {
            $inst->courses()->sync($curso);
            $curso->groups()->sync($request->groups);
            return $message = "El curso ".$request['course_name'].' se ha guardado';
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
        $curso = Course::find($id);
        $grupo = Course::find($id)->groups;
        $select2 = [];
        foreach ($grupo as $grupos) {
            $select2[] = ['id' => $grupos->id, 'text' => $grupos->group_name];
        }
        $array = array($curso, $select2);
        return response()->json($array);
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
        $curso = Course::find($id);
        $user_id = Auth::User()->id;
        $user = User::find($user_id);
        $inst = $user->institute;

        $rules = [
            'name'   =>  'required',
            'hours' =>  'required|max:12',
            'description'   =>  'required',
            'groups'    =>  'required'
        ];

        $msg = [
            'name.required'  =>  'El nombre del curso es necesario',
            'hours.required'    => 'Es necesario especificar las horas del curso',
            'hours.max' =>  'No te puedes exeder de las 12 hrs.',
            'description.required'  =>  'Es necesario tener una descripción del curso',
            'groups.required'    =>  'Se debe saber a que grupos se les imparte el curso'
        ];

        $this->validate($request, $rules, $msg);

        $curso->course_name =  $request['name'];
        $curso->hours   =  $request['hours'];
        $curso->description =   $request['description'];

        if ($request->ajax()) {
            $curso->save();
            $inst->courses()->sync($curso);
            $curso->groups()->sync($request->groups);
            return $message = "El curso ".$curso->course_name." se ha actualizado";
        }
        return response()-json($curso);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $curso = Course::find($id);
        if ($request->ajax()) {
            $curso->groups()->detach();
            $curso->institutes()->detach();
            $curso->delete();
            return $message = "El curso se ha eliminado";
        }
        return response()->json($curso);
    }

    public function TableCurso()
    {
        $user = User::find(Auth::User()->id);
        $inst = $user->institute;
        return datatables()->of(DB::table('course_institute')
            ->join('courses', 'course_institute.course_id', '=', 'courses.id')
            ->where('course_institute.institute_id', '=', $inst->id)
            ->get())->toJson();
    }
}
