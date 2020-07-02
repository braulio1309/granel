<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $fillable = [
        'nombre', 'categoria_id', 'precio', 'stock', 'imagen'
    ];
}
