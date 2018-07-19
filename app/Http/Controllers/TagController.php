<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Tag;

class TagController extends Controller
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
            'tag_name' => 'required|unique:tags'
        ];

        $msg = [
            'tag_name.required' =>  'El nombre del tag es necesario',
            'tag_name.unique'   =>  'Solo puede existir un mismo tag'
        ];

        $this->validate($request, $rules, $msg);

        $tag = Tag::Create([
            'tag_name' =>   $request['tag_name']
        ]);

        if ($request->ajax()) {
            return $message = "El tag se ha añadido";
        }
        return response()->json($tag);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        return $tag;
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
        $tag = Tag::find($id);
        $rules = [
            'tag_name'  =>  'required|unique:tags'
        ];

        $msg = [
            'tag_name.required' =>  'El nombre del tag es necesario',
            'tag_name.unique'   =>  'Solo puede existir un mismo tag'
        ];

        $this->validate($request, $rules, $msg);

        $tag->tag_name  =   $request['tag_name'];

        if ($request->ajax()) {
            $tag->save();
            return $message = "El tag se ha actualizado";
        }
        return response()->json($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $tag = Tag::find($id);

        if ($request->ajax()) {
            $tag->delete();
            return $message = "El tag ha sido eliminado";
        }
        return response()->json($tag);
    }

    public function TableTag()
    {
        return dataTables()->of(DB::table('tags')
            ->get())->toJson();
    }

    public function selectTag(Request $request)
    {
        $term = $request->term;

        if (empty($term)) {
            $tag = Tag::all();
        }
        else {
            $tag = DB::table('tags')
            ->select('id', 'tag_name')
            ->where('tag_name', 'like', '%'.$term.'%')
            ->get();
        }
        $select = [];
        foreach ($tag as $data) {
            $select[] = ["id" => $data->id, "text" => $data->tag_name];
        }
        return response()->json($select);
    }
}
