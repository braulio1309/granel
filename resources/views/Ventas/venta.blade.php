@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Proceso de compra</h1>
@stop
@section('content')

<div class="container">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h2>Producto a vender: {{$producto->nombre}}</h2>
            </div>
            <div class="card-body">
                <form action="{{route('ventas', [ 'producto_id' => $producto->id, 'maquina_id' => $maquina_id])}}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label> Correo electronico  </label>
                        <input 
                            type="text" 
                            name="email" 
                            class="form-control" 
                        >
                    </div>

                    <div class="form-group">
                        <label> Nombre </label>
                        
                        <input type="text" 
                        name="name" 
                        class="form-control" 
                        value="{{$producto->nombre}}" 
                        readonly="readonly"
                        required>
                    </div>
                    
                    
                    <div class="form-group">
                        <label> Precio </label>
                        <input 
                            type="number" 
                            name="precio" 
                            class="form-control" 
                            value="{{$producto->precio}}"
                            readonly="readonly"
                        >
                    </div>

                    <div class="form-group">
                        <label> Cantidad </label>
                        <input 
                            type="number" 
                            name="cantidad" 
                            class="form-control" 
                            min="1"
                            
                            
                        >
                    </div>

                    <div class="form-group">
                        <label> Número de la tarjeta </label>
                        <input 
                            type="text" 
                            name="card" 
                            class="form-control" 
                        >
                    </div>

                    <div class="form-group">
                        <label> Código de seguridad (detrás de la tarjeta) </label>
                        <input 
                            type="password" 
                            name="code" 
                            class="form-control" 
                        >
                    </div>

                    <div class="form-group">
                        <label> Mes/año de vencimiento </label>
                        <input 
                            type="text" 
                            name="vencimiento" 
                            class="form-control" 
                        >
                    </div>

                    <input class="btn btn-primary" type="submit" value="Vender">

                </form>
            </div>
        </div>
    </div>
</div>

@endsection