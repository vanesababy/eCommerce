@extends('adminlte::page')

@section('title', 'Crear Rol')

@section('content_header')
    <h1><i class="fas fa-user-shield mr-2"></i>Crear Nuevo Rol</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="card-title">Datos del Nuevo Rol</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('roles/guardar') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del Rol</label>
                    <input type="text" name="name" class="form-control" placeholder="Ingrese el nombre del rol" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Permisos</label>
                    @foreach($permisos as $permiso)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permisos[]" value="{{ $permiso->id }}">
                            <label class="form-check-label">{{ $permiso->name }}</label>
                        </div>
                    @endforeach
                </div>


                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Guardar</button>
                    <a href="{{ url('roles') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i>Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
