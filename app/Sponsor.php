<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $fillable = [
        'sponsor_name', 'image',
    ];

    public function institutes()
    {
        return $this->belongsToMany('App\Institute');
    }
}
