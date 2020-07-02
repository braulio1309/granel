<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

//Llamamos modelos
use App\Categorias;
use App\Productos;

class ProductosController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');

    }

    public function registro(request $request)
    {
        //Validación
        $validar = \Validator::make($request->all(), [
            'name'          => 'required',
            'categorias'    => 'required',
            'precio'        => 'required',
            'stock'         => 'required'
            
        ]);
        
        $imagen = $request->file('imagen');
        if($imagen){
            $name_image = time().$imagen->getClientOriginalName();

            storage::disk('public')->put($name_image, File::get($imagen));
        }else{
            $imagen = null;
        }
        
        
        //Guardamos datos
        $producto = Productos::create([
            'nombre'        => $request->input('name'),
            'categoria_id'  => $request->input('categorias'),
            'precio'        => $request->input('precio'),
            'imagen'        => $name_image
        ]);
        

        return redirect()->route('mostrar');
        
    }

    public function getImagen($archivo)
    {

        $file = Storage::disk('public')->get($archivo);
        
        return new Response($file, 200);
    }

    public function registro_vista()
    {
        $categorias = Categorias::all();

        return view('Productos/registro',[
            'categorias' => $categorias
        ]);
    }

    public function mostrar()
    {
        $produc = Productos::all();
       
        return view('Productos/mostrar', [
            'productos' => $produc
        ]);
    }

    public function eliminar($id)
    {
        Productos::destroy($id);

        return redirect()->route('mostrar');
    }

    public function editar_vista($id)
    {
        
        $producto = Productos::where('id', '=', $id)->get();
        $categorias = Categorias::all();


       
        return view('Productos/editar', [
                'producto'   => $producto[0],
                'categorias' => $categorias
            ]);
    }

    public function editar($id, request $request)
    {

        //Devuelve un arreglo
        $producto = Productos::where('id', '=', $id)->get();
        $producto = $producto[0];

        $producto->nombre = $request->input('name');
        $producto->precio = $request->input('precio');
        $producto->stock = $request->input('stock');
        $producto->categoria_id = $request->input('categorias');

        $producto->save();

        return redirect()->route('mostrar');
    }
}
