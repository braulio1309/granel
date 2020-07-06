<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Charts\VentasGrafico;
use App\Exports\VentasExport;
use App\Productos;
use App\Ventas;
use App\Stock;
use App\User;
use DB;
//use Mail; 
use Illuminate\Support\Facades\Mail;
//use App\Mail\OrderShipped;



class VentasController extends Controller
{
    public function ventas_vista($id)
    {
        $producto = DB::table('maquinas')
        ->join('stock', 'maquinas.id', '=', 'stock.maquina_id')
        ->join('productos', 'productos.id', '=', 'stock.producto_id')
        ->select('maquinas.*')
        ->where('stock.producto_id', '=', $id)
        ->get();

        return view('Maquinas/elegir', [
            'maquinas'      => $producto,
            'producto_id'   => $id
        ]);
    }

    public function elegir($maquina_id, $producto_id)
    {
        $producto = DB::table('maquinas')
        ->join('stock', 'maquinas.id', '=', 'stock.maquina_id')
        ->join('productos', 'productos.id', '=', 'stock.producto_id')
        ->select('productos.nombre AS nombre', 'productos.id', 'productos.precio')
        ->where('stock.producto_id', '=', $producto_id)
        ->where('stock.maquina_id', '=', $maquina_id)

        ->get();

        return view('Ventas/venta', [
            'maquina_id'    => $maquina_id,
            'producto_id'   => $producto_id,
            'producto'      => $producto[0]
        ]);
    }

    public function ventas($maquina_id, $producto_id, request $request)
    {
        $producto = Productos::where('id', '=', $producto_id)->get();
        $producto = $producto[0];
        $preciofinal = $request->input('cantidad') * $producto->precio;
        //$maquina_id = $request->input('maquina_id');
        $stock = DB::table('stock')
            ->where('maquina_id','=', $maquina_id)
            ->where('producto_id', '=', $producto_id)
            ->get();
       // var_dump($stock);die();

        $stock = $stock[0];

        if($stock->cantidad - $request->input('cantidad')<0){
            $request->session()->flash('alert-danger', 'No hay existencia suficiente del producto!');
            return redirect()->route('mostrar')->with('message','Danger');
        }else{
            $venta = Ventas::create([
                'producto_id'   => $producto->id,
                'usuario_id'    => Auth::user()->id,
                'maquina_id'    => 1,
                'estado'        => 'R',
                'costo'         => $preciofinal,
                'cantidad'      => $request->input('cantidad')
            ]);
        }

        $pdf = [
            'id'    => $venta->id,
            'title' => 'Granel',
            'body'  => 'Su compra ha sido exitosa, verifique los datos:',
            'datos' => "Producto: $producto->nombre, Precio total: $preciofinal, Cantidad: $venta->cantidad",
        ];
        $detalles = [
            'id'    => $venta->id,
            'title' => 'Granel',
            'body'  => 'Su compra ha sido exitosa, verifique los datos:',
            'datos' => "Producto: $producto->nombre, Precio total: $preciofinal, Cantidad: $venta->cantidad",
            'pdf'   =>  \PDF::loadView('email.qr',['pdf' => $pdf])->save(storage_path('app/public/') .'archivo'.$venta->id.'.pdf')
        ];
       // cristianstanga@gmail.com
       \Mail::to($request->input('email'))->send(new \App\Mail\Venta($detalles));
       

        if(isset($venta->id))
        {
            $stock->cantidad = $stock->cantidad - $request->input('cantidad');
            $producto->save();
        }

        $request->session()->flash('alert-success', 'Su venta ha sido exitosa!');
        return redirect()->route('mostrar');

    }


    public function AllVentas()
    {
       //Instaciamos Modelos o clase
        $ventas = new Ventas();
        //Retornamos el método
        return view('Ventas/AllVentas',[
            'ventas' => $ventas->AllVentas(),
            
        ]);
    }

    public function MisCompras()
    {
        $ventas = Ventas::
        join('productos', 'productos.id', '=', 'ventas.producto_id')
        ->where('usuario_id', '=',Auth::user()->id)->get();
        $user = [
            'idAction' => 1,
            'idProducto' => 1,
            'precio' => 50

        ];
        $json = json_encode($user);

        return view('Ventas/AllVentas', [
            'ventas' => $ventas,
            'json'   => $json
        ]);
    }

    public function Detalle($id)
    {
        $venta = Ventas::where('id', '=', $id)->get();

        return view('Ventas/detalles', [
            'venta' => $venta[0]
        ]);
    }
    

    public function AllVentas_excel()
    {
        return Excel::download(new VentasExport, 'ventas.xlsx');
    }

    public function graficos()
    {
        // Instanciamos el objeto gráfico 
        $chart = new VentasGrafico();
        $ventas = new Ventas();
                
        $chart->title("Ventas", 18); // titulo y tamaño

        $registros = DB::table('ventas')
            ->join('users', 'users.id', '=', 'ventas.usuario_id')
            ->join('productos', 'productos.id', '=', 'ventas.producto_id')
            ->select('productos.id', 'ventas.id', 'users.name', 'productos.nombre', 'ventas.cantidad', 'ventas.costo')
            //->sum('ventas.cantidad');
            ->groupBy('productos.id');
            
            //->get();
        
        //var_dump($registros);die();
        $labels = collect();
        $valores = collect();
        $coloresFondo = collect();

        $cont = 0;
        $colores = [
            'blue',
            'pink',
            'yellow',
            'black',
            
        ];
        foreach ($registros as $registro) 
        {
            if ($cont == 3){
                $cont = 0;
            }
            $labels->push($registro->name);
            $valores->push($registro->costo);
            $coloresFondo->push($colores[$cont]);
            $cont++;
        }

        $chart->labels($labels);
        $dataset = $chart->dataset('Conjunto', 'pie', $valores); // ‘pie’ es el tipo de gráfico
        $dataset->backgroundColor($coloresFondo);

        return view('Ventas/grafico', [
            'grafico' => $chart
        ]);

    }

   
}
