@extends('adminlte::page')
@extends('plantillas.plantillaEstilos')

@section('title', 'Lista de productos')

@section('content_header')
    <h1>
        <i class="fas fa-hamburger mr-2"></i>Lista de productos
    </h1>
@stop


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Catálogo de productos</h3>
                    <div class="card-tools">
                        <a href="{{ url('crear-p') }}" class="btn btn-primary">
                            <i class="fas fa-plus mr-1"></i>Crear producto
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr class="bg-light">
                                <th>ID</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Disponible</th>
                                <th>Categoria</th>
                                <th>Fecha de creación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $producto)
                            <tr>
                                <td>{{ $producto->id }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" 
                                         alt="{{ $producto->nombre }}" 
                                         class="img-thumbnail" 
                                         style="max-width: 80px; max-height: 80px;">
                                </td>
                                <td>{{ $producto->nombre }}</td>
                                <td>{{ Str::limit($producto->descripcion, 50) }}</td>
                                <td>${{ $producto->precio }}</td>
                                <td>
                                    @if($producto->disponible == 'si')
                                        <span class="badge badge-success">Disponible</span>
                                    @else
                                        <span class="badge badge-danger">No disponible</span>
                                    @endif
                                </td>
                                <td>{{ $producto->categoria_nombre }}</td>
                                <td>{{ date('d/m/Y', strtotime($producto->created_at)) }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ url('editar-producto/'.$producto->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $producto->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    
                                    <div class="modal fade" id="deleteModal{{ $producto->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger">
                                                    <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Estás seguro de que deseas eliminar la producto "{{ $producto->nombre }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <form action="{{ url('eliminar-producto/'.$producto->id) }}" method="POST">
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
                <div class="card-footer clearfix">
                    {{ $productos->links() }}
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