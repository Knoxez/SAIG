<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'title', 'fecha_ini', 'fecha_fin', 'monday', 'thuesday', 'wednesday', 'thursday', 'friday', 'institute_id'
    ];
}
