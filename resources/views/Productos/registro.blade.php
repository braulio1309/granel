@extends('adminlte::page')

@section('title', 'Producto')

@section('content_header')
    <h1 class="m-0 text-dark">Registre un producto</h1>
@stop


@section('content')

<div class="container">
    <div class="col">
        <div class="card">
            
            <div class="card-body">
                <form action="{{route('Productoregistro')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label> Nombre </label>
                        <input type="text" name="name" class="form-control" placeholder="Arroz" required>
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
                        >
                    </div>

                    <div class="form-group">
                        <label> Imágen </label>
                        <input 
                            type="file" 
                            name="imagen" 
                            class="form-control" 
                        >
                    </div>

                    <input class="btn btn-primary" type="submit" value="Registrar">

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

