@extends('adminlte::page')

@section('title', 'Editar Rol')

@section('content_header')
    <h1><i class="fas fa-user-edit mr-2"></i> Editar Rol</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-warning">
            <h3 class="card-title">Modificar Rol</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('/roles/actualizar', $rol->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del Rol</label>
                    <input type="text" name="name" class="form-control" value="{{ $rol->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Permisos</label>
                    @foreach($permisos as $permiso)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permisos[]" value="{{ $permiso->id }}"
                                {{ $rol->hasPermissionTo($permiso->name) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $permiso->name }}</label>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-warning"><i class="fas fa-edit"></i> Actualizar</button>
                <a href="/roles" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
            </form>
        </div>
    </div>
</div>
@stop
