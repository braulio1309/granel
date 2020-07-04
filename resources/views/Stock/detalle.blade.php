@extends('adminlte::page')

@section('title', 'Inventario')

@section('content_header')
<div class="row">
  <h1 class="m-0 text-dark">Inventario</h1>
  <div class="col-sm-8"></div>
  <a href="#" class="btn btn-primary" href="#">Recargar Máquina</a>
</div>
    <hr>
@stop


@section('content')
<div class="container" id="app">
    <div class="row">
        <div class="col-sm-6">
            {!! $grafico->container() !!}
        </div>
    
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

    <div class="col-sm-6">
        {!!$chart->container() !!}

    </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
                {{ $chart->script() }}
    </div>
</div>     

{!! $grafico->script() !!}
@endsection