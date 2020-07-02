<?php

namespace App\Exports;

use App\Ventas;
use Maatwebsite\Excel\Concerns\FromCollection;

class VentasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $ventas = Ventas::
        join('users', 'users.id', '=', 'ventas.usuario_id')
        ->join('productos', 'productos.id', '=', 'ventas.producto_id')
        ->select('ventas.id', 'users.name', 'productos.nombre', 'ventas.cantidad', 'ventas.costo')
        ->get();

        return $ventas;
    }
}
