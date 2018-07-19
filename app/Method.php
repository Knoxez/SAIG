<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    protected $fillable = [
        'method_name', 'content'
    ];

    public function institutes()
    {
        return $this->belongsToMany('App\Institute');
    }
}
