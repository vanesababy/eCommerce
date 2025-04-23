@extends('adminlte::page')
@extends('plantillas.plantillaEstilos')

@section('title', 'Lista de roles')

@section('content_header')
    <h1>
        <i class="fas fa-user-shield mr-2"></i>Lista de roles
    </h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de roles</h3>
                    <div class="card-tools">
                        <a href="{{ url('roles/crear') }}" class="btn btn-primary">
                            <i class="fas fa-plus mr-1"></i>Crear rol
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr class="bg-light">
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Permisos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $rol)
                            <tr>
                                <td>{{ $rol->id }}</td>
                                <td>{{ $rol->name }}</td>
                                <td>
                                    @if($rol->permissions->isNotEmpty())
                                        <span class="badge badge-success">{{ $rol->permissions->pluck('name')->join(', ') }}</span>
                                    @else
                                        <span class="badge badge-secondary">Sin permisos</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ url('roles/editar/'.$rol->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $rol->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <div class="modal fade" id="deleteModal{{ $rol->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger">
                                                    <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Estás seguro de que deseas eliminar el rol "{{ $rol->name }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <form action="{{ url('roles/eliminar/'.$rol->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- <div class="card-footer clearfix">
                    {{ $roles->links() }}
                </div> --}}
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .table th {
        font-weight: 600;
    }
</style>
@stop

@section('js')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    document.addEventListener("DOMContentLoaded", function() {
        @if(session('success'))
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        @endif
    });
</script>
@stop
