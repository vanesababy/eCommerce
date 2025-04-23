@extends('adminlte::page')

@section('title', 'Crear Usuario')

@section('content_header')
    <h1><i class="fas fa-user-plus mr-2"></i>Crear Usuario</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-success">
            <h3 class="card-title">Registrar Nuevo Usuario</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('usuarios-crear') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="rol_id" class="form-label">Rol</label>
                    <select name="rol_id" class="form-control">
                        <option value="" selected disabled>Seleccione un rol</option>
                        @foreach($roles as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save mr-1"></i>Guardar</button>
                    <a href="{{ url('/usuarios') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i>Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
{{-- Script para mostrar/ocultar contraseña --}}
@section('js')
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        let passwordInput = document.getElementById('password');
        let icon = this.querySelector('i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>
@stop
