@extends('adminlte::page')

@section('title', 'Editar')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Producto</h1>
@stop


@section('content')

<div class="container">
    <div class="col">
        <div class="card">
            
            <div class="card-body">
                <form action="{{route('editar', $producto->id)}}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label> Nombre </label>
                        <input type="text" name="name" class="form-control" value="{{$producto->nombre}}" required>
                    </div>
                    
                    <div class="form-group">
                        <label> Categorias </label>
                            <select name="categorias" class="form-control">
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id}}"> {{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                    </div>
                   
                    <div class="form-group">
                        <label> Precio </label>
                        <input 
                            type="number" 
                            name="precio" 
                            class="form-control" 
                            value="{{$producto->precio}}"
                        >
                    </div>

                    <div class="form-group">
                        <label> Stock </label>
                        <input 
                            type="number" 
                            name="stock" 
                            class="form-control" 
                            value="{{$producto->stock}}"
                            
                        >
                    </div>

                    <input class="btn btn-primary" type="submit" value="Editar">

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

