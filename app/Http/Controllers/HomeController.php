<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Role;
use App\Institute;
use App\User;

class HomeController extends Controller
{
   public function __construct()
   {
      $this->middleware('guest');
   }

   public function index(){
      return view('home.index');
   }

   public function getRoles(){
      $roles = Role::All()->except(1);
      return response()->json($roles);
   }

   public function create(){
      return view('home.registro');
   }

   public function store(Request $request){
      $rules = [
         'username'  =>    'required|string|max:255',
         'email'     =>    'required',
         'password'  =>    'required|confirmed|min:8|max:12',
         'schoolkey' =>    'required|unique:institutes',
         'phone'     =>    'required',
         'image'     =>    'required|image|mimes:jpeg,png,jpg|max:3072'
      ];

      $this->validate($request, $rules);

      if ($request->hasFile('image')) {
         // Imagen
         $user = Auth::user();
         $file = $request->file('image');
         $extension = $request->file('image')->getClientOriginalExtension();
         $file_name = $request->schoolkey.'_'.time().'.'.$extension;
         $school = $request->username;
         $carpeta = public_path()."\\images\\".$school;
         if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
         }
         $path = $carpeta;
         $file->move($carpeta, $file_name);
      }

      $institute = new Institute;
      $institute->phone     = $request['phone'];
      $institute->address   = $request['address'];
      $institute->schoolkey = $request['schoolkey'];
      $institute->image     = $file_name;

      $user = new User;
      $user->username      = $request['username'];
      $user->email         = $request['email'];
      $user->password      = Hash::make($request['password']);
      $user->role_id       = $request['roles'];

      if ($request->ajax()) {
         $institute->save();
         $institute->users()->save($user);
         return view ('admin.bienvenido');
      }
      return response()->json($institute, $user);
   }

   public function getuser($name){
      $user = User::All()->where('username', $name);
      return response()->json($user);
   }

   public function getemail($email){
      $user = User::All()->where('email', $email);
      return response()->json($user);
   }

   public function getkey($key){
      $institute = Institute::All()->where('schoolkey', $key);
      return response()->json($institute);
   }

}
