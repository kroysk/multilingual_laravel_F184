<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //timestams false
    public $timestamps = false;
    protected $table = 'languages';
    protected $fillable = ['id', 'name', 'code'];
}


