@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
    <h1 class="m-0 text-dark">Inventario de Máquinas</h1>
    <hr>
@stop

@section('content')

<div class="container-fluid">
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <select name="zona" class="form-control">
                <option name="#">Misiones</option>
                <option name="#">Centro</option>
                <option name="#">Sur</option>
            </select>


        </div>
        <input type="submit" class="btn btn-primary btn-block" value="Filtrar">
    </form>

</div>

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
            <a href="#" class="btn btn-success">Stock</a>
         </td>
           
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection