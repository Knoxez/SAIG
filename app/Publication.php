<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = [
        'title', 'image', 'description', 'content', 'user_id', 'type_id', 'status',
    ];

    protected $dates = ['updated_at', 'created_at'];

    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
