@extends('adminlte::page')

@section('title', 'Reporte')

@section('content_header')
    <h1 class="m-0 text-dark">Reportes</h1>
@stop
@section('content')
<div id="app">
    {!! $grafico->container() !!}
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

{!! $grafico->script() !!}
@endsection

