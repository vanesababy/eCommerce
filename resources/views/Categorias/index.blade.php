@extends('adminlte::page')
@extends('plantillas.plantillaEstilos')

@section('title', 'Lista de categorias')

@section('content_header')
    <h1>
        <i class="fas fa-hamburger mr-2"></i>Lista de categorias
    </h1>
@stop


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Catálogo de categorias</h3>
                    @can('Crear menu')
                        <div class="card-tools">
                            <a href="{{ url('crear-c') }}" class="btn btn-primary">
                                <i class="fas fa-plus mr-1"></i>Crear categoria
                            </a>
                        </div>
                    @endcan

                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr class="bg-light">
                                <th>ID</th> 
                                <th>Nombre</th>
                                <th>Descripción</th>
                                @canany(['Editar menu', 'Eliminar menu'])
                                    <th>Acciones</th>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categorias as $categoria)
                            <tr>
                                <td>{{ $categoria->id }}</td>
                                
                                <td>{{ $categoria->nombre }}</td>
                                <td>{{ Str::limit($categoria->descripcion, 50) }}</td>
                                
                                @canany(['Editar menu', 'Eliminar menu'])
                                <td>
                                    <div class="btn-group">
                                        @can('Editar menu')
                                            <a href="{{ url('editar-C/'.$categoria->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('Eliminar menu')
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $categoria->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endcan
                                    </div>
                                    
                                    <div class="modal fade" id="deleteModal{{ $categoria->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger">
                                                    <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Estás seguro de que deseas eliminar la categoria "{{ $categoria->nombre }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <form action="{{ url('eliminar-c/'.$categoria->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                @endcanany
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $categorias->links() }}
                </div>
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
    .img-thumbnail {
        border-radius: 4px;
        object-fit: cover;
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
        
        @if(session('error'))
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: "{{ session('error') }}",
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

        @if(session('warning'))
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: "{{ session('warning') }}",
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

        @if(session('info'))
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: "{{ session('info') }}",
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