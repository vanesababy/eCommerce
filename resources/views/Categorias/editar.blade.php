@extends('adminlte::page')

@section('title', 'Editar categoria')

@section('content_header')
    <h1>Editar categoria</h1>
@stop

@section('content')
<style>
    .img-preview {
        max-width: 100%;
        max-height: 300px; /* Altura reducida */
        object-fit: contain;
        border: 1px solid #dee2e6;
        border-radius: 5px;
    }
    .card {
        overflow: hidden; /* Evita que el contenido se salga */
    }
</style>
@if(session('success'))
<script>
    Swal.fire({
        toast: true,
        position: 'top-start',
        icon: 'success',
        title: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 3000
    });
</script>
@endif

    <div class="container-fluid py-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Editar categoria: {{ $categorias->nombre }}</h4>
            <div>
                <a href="{{ url('vista-categorias') }}" class="btn btn-outline-secondary me-2">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
                <button form="formEditarcategoria" type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar Cambios
                </button>
            </div>
        </div>
        
        <form id="formEditarcategoria" method="POST" action="{{ url('actualizar-c/' . $categorias->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Información General</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="burgerName" class="form-label">Nombre de la categoria</label>
                                <input type="text" class="form-control" name="Nombre" id="burgerName" 
                                       value="{{ $categorias->nombre }}" placeholder="Ingrese el nombre de la categoria">
                                @error('Nombre')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="burgerDescription" class="form-label">Descripción de la categoria</label>
                                <textarea class="form-control" name="descripcion" id="burgerDescription" 
                                          rows="4" placeholder="Descripción detallada...">{{ $categorias->descripcion }}</textarea>
                                @error('descripcion')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card bg-light">
                        <div class="card-body d-flex justify-content-between">
                            <a href="{{ url('lista-categorias') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Cambios
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
        </form>
    </div>

    <!-- Scripts para la vista previa de la imagen -->
    <script>
        document.getElementById('burgerImage').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('burgerPreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            var toastEl = document.getElementById('toastSuccess');
            if (toastEl) {
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            }
        });
    </script>
@stop