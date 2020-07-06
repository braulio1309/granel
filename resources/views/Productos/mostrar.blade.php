@extends('adminlte::page')

@section('title', 'Producto')

@section('content_header')
<div class="row">
  <h1 class="m-0 text-dark">Productos</h1>
  <div class="col-sm-8"></div>
  <a class="btn btn-primary" href="{{route('vista_registro')}}">Nuevo producto</a>
</div>
<div class="flash-message">
  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))

    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
  @endforeach
</div> @stop


@section('content')
<div class="container-fluid">
  

<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-body">
            <div class="row">
            
            @foreach($productos as $producto)
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  @if($producto->imagen)
                    <img class="rounded" src="{{route('imagen', $producto->imagen)}}" style="width: 100%; height:150px;">
                    <br>
                  @endif
                  <h2>{{$producto->nombre}}</h2>
                  <h4>${{$producto->precio}}</h4>
                </div>
                <a class="btn btn-primary" href="{{route('ventas_vista',$producto->id)}}">Comprar</a>
              </div>
            </div>
            @endforeach

          </div>
          </div>
      </div>
  </div>
</div>
</div>


@endsection