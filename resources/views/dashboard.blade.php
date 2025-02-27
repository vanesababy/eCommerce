@extends('adminlte::page')

@section('title', 'Panel de Administración')

@section('content_header')
    <h1>Bienvenido, {{ Auth::user()->name }}</h1>
@stop

@section('content')
    <p>¡Este es tu panel de administración con AdminLTE y Laravel Breeze!</p>
    <p>Esta es la página de inicio para su cuenta.</p>
    
@stop
