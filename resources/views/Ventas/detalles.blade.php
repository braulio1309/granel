@extends('adminlte::page')

@section('title', 'Detalles')

@section('content_header')
<div class="row">
  <h1 class="m-0 text-dark">Detalles</h1>
  
</div>
    
@stop


@section('content')
<div class="container-fluid">

<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-body">

            <div class="form-group">
                <label> Producto </label>
                <input type="text" name="name" class="form-control" value="{{$venta->producto_id}}" placeholder="Arroz" required>
            </div>

            <div class="form-group">
                <label> Cantidad </label>
                <input type="text" name="name" class="form-control" value="{{$venta->cantidad}}" placeholder="Arroz" required>
            </div>
            
            <div class="form-group">
                <label> Precio </label>
                <input 
                    type="number" 
                    name="precio" 
                    class="form-control" 
                    value="{{$venta->costo}}" 
                >
            </div>

            
            <?php $json = [
                'idAction'      => 1,
                'idProducto'    => $venta->producto_id,
                'precio'        => $venta->costo
          ];
          $json = json_encode($json);
          ?>
            <div class="title m-b-md">
              {!!QrCode::size(300)->generate("$json") !!}
           </div>
          </div>
      </div>
  </div>
</div>
</div>


@endsection