<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class animal extends Model
{
    protected $table = 'animal';
    public $timestamps= false;
    protected $fillable = [
        'nombre', 'edad','tipoanimalid',
    ];
}
