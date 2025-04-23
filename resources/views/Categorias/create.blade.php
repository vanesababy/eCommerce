@extends('adminlte::page')

@section('title', 'Panel de Administración')

@section('content_header')
    <h1>lista de hamburgesas</h1>
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

    {{-- <p>¡Hola dede hamburgesa!</p>
    <p>Esta es la página de inicio para su cuenta.</p>
 --}}

    <div class="container-fluid py-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Agregar Nueva categoria</h4>
            <div>
                <button class="btn btn-outline-secondary me-2">
                    <i class="fas fa-save"></i> Guardar Borrador
                </button>
                <button class="btn btn-success">
                    <i class="fas fa-check"></i> Agregar categoria
                </button>
            </div>
        </div>
        
        <form method="POST" action="{{ url('crearCategoria') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Información General</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="burgerName" class="form-label">Nombre de la categoria</label>
                                <input type="text" class="form-control" name="nombre_categoria" id="burgerName" placeholder="Ingrese el nombre de la categoria">
                            </div>
                            
                            <div class="mb-3">
                                <label for="burgerDescription" class="form-label">Descripción de la categoria</label>
                                <textarea class="form-control" name="descripcion_categoria" id="burgerDescription" rows="4" placeholder="Descripción detallada..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <button type="submit">
                crear categoria
            </button>
            
        </form>
    </div>

    <!-- Scripts de Bootstrap y JS para la vista previa de la imagen -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
