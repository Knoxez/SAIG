<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{

   public function login(Request $request){
      $auth = false;
      $credentials = $this->validate(request(), [
         'email' => 'required|email',
         'password' => 'required'
      ]);

      if (Auth::attempt($credentials)) {
         $auth = true;
      }

      if ($request->ajax()) {
         if ($auth) {
            return response()->json([
               $auth,
               'message' => 'Iniciando sesión...'
            ]);
         }
         return response()->json([
            $auth,
            'email'  => trans('auth.failed')
         ]);
      }
   }

   public function logout(){
      Auth::logout();
      return redirect('/');
   }
}
