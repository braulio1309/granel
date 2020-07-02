<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $fillable = [
        'usuario_id', 'producto_id', 'costo', 'cantidad', 'maquina_id', 'estado'
    ];

    public function AllVentas()
    {
        return Ventas::
            join('users', 'users.id', '=', 'ventas.usuario_id')
            ->join('productos', 'productos.id', '=', 'ventas.producto_id')
            ->select('ventas.id', 'users.name', 'productos.nombre', 'ventas.cantidad', 'ventas.costo')
            ->get();
    }
}
