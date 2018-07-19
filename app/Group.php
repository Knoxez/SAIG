<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
      'group_name',
   ];

   public function institutes(){
       return $this->belongsToMany('App\Institute');
   }

   public function courses(){
       return $this->belongsToMany('App\Course');
   }
}
