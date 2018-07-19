<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Type;
use DB;

class TypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
            'type_name' =>  'required|unique:types'
        ];

        $msg = [
            'type_name.required'    =>  'El nombre del tipo de publicación es necesario.',
            'type_name.unique'      =>  'Ya existe este tipo de publicación'
        ];

        $this->validate($request, $rules, $msg);

        $type = Type::Create([
            'type_name' =>  $request['type_name']
        ]);

        if ($request->ajax()) {
            return $message = 'El tipo de publicación '.$request['type_name'].' se ha guardado.';
        }
        return response()->json($type);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = Type::find($id);
        return $type;
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
            'type_name' =>  'required|unique:types'
        ];

        $msg = [
            'type_name.required'    =>  'El nombre del tipo de publicación es necesario',
            'type_name.unique'  =>  'Ya existe este tipo de publicación'
        ];

        $this->validate($request, $rules, $msg);

        $type = Type::find($id);
        $type->type_name = $request['type_name'];

        if ($request->ajax()) {
            $type->save();
            return $message = 'El tipo de publicación se ha actualizado';
        }
        return response()->json($type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $type = Type::find($id);

        if ($request->ajax()) {
            $type->delete();
            return $message = "El tipo de publicación se ha eliminado";
        }
        return response()->json($type);
    }

    /**
     * Display a list of the table.
     *
     * @return \Illuminate\Http\Response
     */
    public function TableType()
    {
        return datatables()->of(DB::table('types')
            ->select(
                DB::raw('id, type_name')
            )
            ->get())->toJson();
    }

    public function selectType(Request $request)
    {
        $term = trim($request->term);

        if (empty($term)) {
            $type = Type::all();
        }
        else {
            $type = DB::table('types')
                ->select('id', 'type_name')
                ->where('type_name', 'like', '%'.$term.'%')
                ->get();
        }
        $select = [];
        foreach ($type as $data) {
            $select[] = ["id" => $data->id, "text" => $data->type_name];
        }
        return response()->json($select);
    }
}
