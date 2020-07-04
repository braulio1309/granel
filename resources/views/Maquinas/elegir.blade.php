@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
    <h1 class="m-0 text-dark">Máquinas disponibles</h1>
    <span>En estas máquinas su producto está disponible, seleccione la de su preferencia</span>
@stop

@section('content')

<hr>
<br>
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Ubicación</th>
        <th scope="col">Acción</th>

      </tr>
    </thead>
    <tbody>
        @foreach($maquinas as $maquina)
        <tr>
            <th scope="row">{{$maquina->id}}</th>
            <td>{{$maquina->nombre}}</td>
            <td>{{$maquina->ubicacion}}</td>

         <td>
            <a href="{{route('ventas.elegir',['maquina_id' => $maquina->id, 'producto_id' => $producto_id])}}" class="btn btn-success">Comprar</a>
         </td>
           
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection