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
use App\User;
use DB;
//use Mail; 
use Illuminate\Support\Facades\Mail;
//use App\Mail\OrderShipped;



class VentasController extends Controller
{
    public function ventas_vista($id)
    {
        $producto = Productos::where('id', '=', $id)->get();

        return view('Ventas/venta', [
            'producto' => $producto[0]
        ]);
    }

    public function ventas($id, request $request)
    {
        $producto = Productos::where('id', '=', $id)->get();
        $producto = $producto[0];

        $preciofinal = $request->input('cantidad') * $producto->precio;
        $maquina_id = $request->input('maquina_id');
        
        $venta = Ventas::create([
            'producto_id'   => $producto->id,
            'usuario_id'    => Auth::user()->id,
            'maquina_id'    => 1,
            'estado'        => 'R',
            'costo'         => $preciofinal,
            'cantidad'      => $request->input('cantidad')
        ]);

        

        $detalles = [
            'id'    => $venta->id,
            'title' => 'Granel',
            'body'  => 'POR FIN',
            'venta' => 'Estas aprobado bro',
            'pdf'   =>  \PDF::loadView('email.qr',$venta)->save(storage_path('app/public/') .'archivo'.$venta->id.'.pdf')
        ];
       // cristianstanga@gmail.com
       \Mail::to('brauliozapatad@gmail.com')->send(new \App\Mail\Venta($detalles));
       

        if(isset($venta->id))
        {
            //$producto->stock = $producto->stock - $request->input('cantidad');
            $producto->save();
        }

        return redirect()->route('mostrar');

    }

    public function ventasMaquina($id, request $request)
    {
        $producto = Productos::where('id', '=', $id)->get();
        $producto = $producto[0];

        $preciofinal = $request->input('cantidad') * $producto->precio;

        //Información del usuario logueado
        
        $usuario_id = User::where('email', '=', 'maquina@gmail.com')->get();
        $usuario_id = $usuario_id[0]->id;

        $venta = Ventas::create([
            'producto_id'   => $producto->id,
            'usuario_id'    => $usuario_id,
            'costo'         => $preciofinal,
            'cantidad'      => $request->input('cantidad')
        ]);

        if(isset($venta->id))
        {
            $producto->stock = $producto->stock - $request->input('cantidad');
            $producto->save();
        }

        $data = [
            'nro_venta' => $venta->id,
            'code'      => 200,
            'usuario_id'=> $usuario_id,
            'costo'     => $preciofinal,
            'cantidad'  => $request->input('cantidad')
        ];

        return response()->json($data, $data['code']);

    }

    public function AllVentas()
    {
     
       //Instaciamos Modelos o clase
        $ventas = new Ventas();

        //$ventas =  $ventas->AllVentas(); Cuidado

        //Retornamos el método
        return view('Ventas/AllVentas',[
            'ventas' => $ventas->AllVentas(),
            
        ]);
    }

    public function MisCompras()
    {
        $ventas = Ventas::where('usuario_id', '=',Auth::user()->id)->get();
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

    public function productosAgrupados()
    {
        $productos =  DB::table('ventas')
            ->join('productos', 'productos.id', '=', 'ventas.producto_id')
            ->select('nombre', 'cantidad')
            ->groupBy('productos.id', 'nombre', 'cantidad')
            ->get();

        /*$productos2 = DB::select("SELECT 'productos.nombre' ,'sum(ventas.cantidad)' FROM 'ventas' 
                        INNER JOIN 'productos' where 'productos.id' = 'ventas.producto_id' 
                        group by 'producto_id' ");*/
                    


        var_dump($productos); die();
    }
}
