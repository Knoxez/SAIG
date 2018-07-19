<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
      'course_name', 'hours', 'description',
    ];

    public function institutes(){
        return $this->belongsToMany('App\Institute');
    }

    public function groups(){
        return $this->belongsToMany('App\Group');
    }
}
