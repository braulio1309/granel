<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagenes extends Model
{
    protected $fillable = [
        'nombre', 'producto_id'
    ];
}
