@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
    <h1 class="m-0 text-dark">Ventas</h1>
    <hr>
@stop

@section('content')

<div class="container">
  <div class="row">
    <div class="col-sm-2">
      <a href="{{route('AllVentas_excel')}}" class="btn btn-success">Descargar</a>
    </div>
  
    <div class="col-sm-4">
      <a href="{{route('grafico')}}" class="btn btn-success">Grafico</a>
    </div>
  </div>
  <br>
</div>
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Producto</th>
        <th scope="col">Cantidad</th>
        <th scope="col">Costo</th>
        <th scope="col"> QR </th>
        <th scope="col"> Acción </th>

      </tr>
    </thead>
    <tbody>
        @foreach($ventas as $venta)
        <tr>
            <th scope="row">{{$venta->id}}</th>
            <td>{{$venta->producto_id}}</td>
            <td>{{$venta->cantidad}}</td>
            <td>{{$venta->costo}}</td>
            <?php $json = [
              'idAction' => 2,
              'idProducto' => $venta->producto_id,
              'precio' => $venta->costo
        ];
        $json = json_encode($json);
        ?>
          <td><div class="title m-b-md">
            {!!QrCode::size(100)->generate("$json") !!}
         </div></td>

         <td>
            <a href="{{route('ventas.detalle',$venta->id)}} "class="btn btn-success">Detalle</a>
         </td>
           
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection