<?php

namespace App\Http\Controllers;
use App\Maquinas;
use App\Stock;
use App\Ventas;
use DB;
use App\Charts\Productos;
use App\Charts\VentasGrafico;

use Illuminate\Http\Request;

class MaquinasController extends Controller
{
    public function AllMaquinas()
    {
        $maquinas = Maquinas::all();

        return view('Maquinas/todas',[
            'maquinas' => $maquinas
        ]);
    }

    public function detalle($id)
    {
        $grafico = new Productos();
        $grafico->title('Inventario', 18); // titulo y tamaño

        $registros = DB::table('stock')
        ->select('productos.nombre AS nombre', 'stock.cantidad')
        ->join('productos', 'productos.id', '=', 'stock.producto_id') 
        ->where('maquina_id', '=', $id)
        ->get();
        //var_dump($registros);die();
        $labels = collect();
        $valores = collect();
        $coloresFondo = collect();
        

        //$valores->push(["0", '10', '20']);
        $cont = 0;
        foreach ($registros as $registro) {
            $labels->push(["$registro->nombre"]);
            $valores->push(["$registro->cantidad"]);
            $coloresFondo->push('blue');
        }

        $grafico->labels($labels);
        $dataset = $grafico->dataset('Conjunto datos', 'horizontalBar', $valores); // ‘pie’ es el tipo de gráfico
        $dataset->backgroundColor($coloresFondo);

        // Instanciamos el objeto gráfico 
        $chart = new VentasGrafico();
                
        $chart->title("Ventas", 18); // titulo y tamaño

        $registros = Ventas::
        join('Productos', 'productos.id', '=', 'ventas.producto_id')
        ->select('ventas.id', 'productos.nombre', 'ventas.cantidad')
        ->where('ventas.maquina_id', '=', $id)
        ->groupBy('productos.nombre','ventas.id', 'ventas.cantidad')
        ->selectRaw('sum(ventas.costo) as costo' )
        ->get(); 
        $labels = collect();
        $valores = collect();
        $coloresFondo = collect();
        $totales = collect();

        $cont = 0;
        $colores = [
            'blue',
            'pink',
            'yellow',
            'red',
            'green',
            'black',
            
        ];
        foreach ($registros as $registro) 
        {
            if ($cont == 5){
                $cont = 0;
            }
            $labels->push($registro->nombre);
            $valores->push($registro->costo);
            $coloresFondo->push($colores[$cont]);
            $totales->push($registro->total);
            $cont++;
        }

        $chart->labels($labels);
        $dataset = $chart->dataset('Conjunto', 'pie', $valores); // ‘pie’ es el tipo de gráfico
        $dataset->backgroundColor($coloresFondo);
                

        // colores de fondo será una collección de colores web (https://htmlcolorcodes.com/es/nombres-de-los-colores/)

        return view('Stock/detalle', [
            'grafico' => $grafico,
            'chart'   => $chart
        ]);
 
    }
}
