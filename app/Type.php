<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
      'type_name',
   ];

   public function publications()
   {
       return $this->belongsToMany('App\Publication');
   }
}
