<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    protected $fillable = [
      'address', 'history', 'mision', 'vision', 'image', 'phone', 'schoolkey',
   ];

   public function users(){
      return $this->hasMany('App\User');
   }
}
