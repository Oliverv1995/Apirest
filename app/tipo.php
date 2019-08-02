<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipo extends Model
{
    protected $table = 'tipoanimal';
    public $timestamps= false;
    protected $fillable = [
        'descripcion',
    ];
}
