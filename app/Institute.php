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

   public function groups(){
       return $this->belongsToMany('App\Group');
   }

   public function courses(){
       return $this->belongsToMany('App\Course');
   }

   public function methods()
   {
       return $this->belongsToMany('App\Method');
   }

   public function sponsors()
   {
       return $this->belongsToMany('App\Sponsor');
   }
}
