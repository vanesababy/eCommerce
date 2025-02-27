@extends('adminlte::page')

@section('title', 'Panel de Administración')

@section('content_header')
    <h1>lista de hamburgesas</h1>
@stop

@section('content')
    <p>¡Hola dede hamburgesa!</p>
    <p>Esta es la página de inicio para su cuenta.</p>

    <a href="{{ url('crear-h') }}" class="btn btn-primary">
        crear hamburguesas
    </a>
    
@stop
