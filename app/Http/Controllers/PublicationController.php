<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use DomDocument;
use Image;
use App\Tag;
use App\Type;
use App\User;
use App\Publication;

class PublicationController extends Controller
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
        $publications = DB::table('publications')
            ->select(DB::raw('id, title, image, description, (select t.type_name from saig.types t where t.id = publications.type_id) as type, updated_at, (select username from users u where u.id = publications.user_id) as username, status'))
            ->where('user_id', '=', $user_id)
            ->orderBy('status', 'DESC')
            ->orderBy('updated_at', 'DESC')
            ->paginate(8);
        return view('admin.publications.publicaciones')
            ->with('publications', $publications)
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
        $type = Type::all();
        $tag = Tag::all();
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $inst = $user->institute;
        $image = $user->username."/".$inst->image;
        return view('admin.publications.crear')
            ->with('user', $user)
            ->with('inst', $inst)
            ->with('image', $image)
            ->with('types', $type)
            ->with('tags', $tag);
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
        $rules = [
            'title' =>  'required',
            'description' =>    'required',
            'image' =>  'required',
            'type'  =>  'required',
            'tags'  =>  'required',
            'code'   =>  'required'
        ];

        $msg = [
            'title.required'    =>  'La publicación debe tener un título',
            'description.required'  => 'La descripción es necesaria para el lector',
            'image.required'    => 'Se necesita una imagen que corresponda a la publicación',
            'type.required'  => 'Debes seleccionar el tipo de publicación',
            'tags.required' =>  'Debes agreagar las etiquetas relacionadas con la publicación',
            'code.required'  =>  'El contenido es muy necesario para la publicación'
        ];

        $this->validate($request, $rules, $msg);

        if ($request->hasFile('image')) {
            // Image
            $file = $request->file('image');
            $extension = $request->file('image')->getClientOriginalExtension();
            $school = Auth::User()->username;
            $file_name = 'Titulo_'.$request->title.'_'.time().'.'.$extension;
            $carpeta = public_path()."\\images\\".$school."\\publications\\".$request->title;
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }
            $path = $carpeta;
            $file->move($carpeta, $file_name);
        }

        $content = $request->code;
        $dom = new DOMDocument();
        $dom->loadHtml(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');

            if (preg_match('/data:image/', $src)) {

                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];

                $file_name = $request->title.'_'.time().'.'.$mimetype;
                $filepath = $carpeta.'\\'.$file_name;

                $image = Image::make($src)
                    ->encode($mimetype, 100)
                    ->save($filepath);

                $new_src = asset("images/".$school."/publications/".$request->title.'/'.$file_name);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);

            }
        }

        $data = [
            'title' =>  $request->title,
            'description'   =>  $request->description,
            'image' =>  $file_name,
            'user_id'   =>  $user->id,
            'type_id'   =>  $request->type,
            'content'   =>  $dom->saveHTML()
        ];

        if ($request->ajax()) {
            $publication = Publication::Create($data);
            $publication->tags()->sync($request->tags);
            return $message = "La publicación se ha añadido";
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
        $public = Publication::find($id);
        $my_tags =  $public->tags->pluck('id')->toArray();
        $type = Type::all();
        $tag = Tag::all();
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $inst = $user->institute;
        $image = $user->username."/".$inst->image;
        return view('admin.publications.editar')
            ->with('user', $user)
            ->with('inst', $inst)
            ->with('image', $image)
            ->with('public', $public)
            ->with('type', $type)
            ->with('tag', $tag)
            ->with('my_tags', $my_tags);
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
        $public = Publication::find($id);
        $user = User::find(Auth::User()->id);
        $rules = [
            'title' =>  'required',
            'description' =>    'required',
            'image' =>  'image',
            'type'  =>  'required',
            'tags'  =>  'required',
            'code'   =>  'required'
        ];

        $msg = [
            'title.required'    =>  'La publicación debe tener un título',
            'description.required'  => 'La descripción es necesaria para el lector',
            'image.image'    => 'El archivo debe ser una imagen',
            'type.required'  => 'Debes seleccionar el tipo de publicación',
            'tags.required' =>  'Debes agreagar las etiquetas relacionadas con la publicación',
            'code.required'  =>  'El contenido es muy necesario para la publicación'
        ];

        $this->validate($request, $rules, $msg);
        $school = Auth::User()->username;
        $carpeta = public_path()."\\images\\".$school."\\publications\\".$request->title;

        if ($request->hasFile('image')) {
            // Image
            $file = $request->file('image');
            $extension = $request->file('image')->getClientOriginalExtension();
            $name = str_replace(" ", "_", $request->title);
            $file_name = 'Titulo_'.$name.'_'.time().'.'.$extension;
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }
            $path = $carpeta;
            $file->move($carpeta, $file_name);
        } else {
            $ext = explode('.', $public->image);
            $name = str_replace(" ", "_",$request->title);
            $file_name = 'Titulo_'.$name.'_'.time().'.'.$ext[1];
            rename($carpeta."/".$public->image, $carpeta."/".$file_name);
        }

        $content = $request->code;
        $dom = new DOMDocument();
        $dom->loadHtml(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');

            if (preg_match('/data:image/', $src)) {

                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];

                $file_name = $request->title.'_'.time().'.'.$mimetype;
                $filepath = $carpeta.'\\'.$file_name;

                $image = Image::make($src)
                    ->encode($mimetype, 100)
                    ->save($filepath);

                $new_src = asset("images/".$school."/publications/".$request->title.'/'.$file_name);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);

            }
        }


        $public->title = $request->title;
        $public->description = $request->description;
        $public->image = $file_name;
        $public->user_id = $user->id;
        $public->type_id = $request->type;
        $public->content = $dom->saveHTML();

        if ($request->ajax()) {
            $public->save();
            $public->tags()->sync($request->tags);
            return $message = "La publicación se ha actualizado";
        }
        return response()->json($data);
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

    public function change(Request $request, $id)
    {
        $public = Publication::find($id);

        if ($request->status == "Activar") {
            $public->status = 'ON';
            $public->save();
            return $message = "Activado";
        } else if ($request->status == "Desactivar") {
            $public->status = 'OFF';
            $public->save();
            return $message = "Desactivado";
        }
    }
}
