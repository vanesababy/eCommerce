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
            <h4>Agregar Nueva producto</h4>
            <div>
                <button class="btn btn-outline-secondary me-2">
                    <i class="fas fa-save"></i> Guardar Borrador
                </button>
                <button class="btn btn-success">
                    <i class="fas fa-check"></i> Agregar producto
                </button>
            </div>
        </div>
        
        <form method="POST" action="{{ url('crearProducto') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Información General</h5>
                        </div>
                        
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="categoria" class="form-label d-block">Seleccione una categoría</label>
                                <select name="id_categoria" id="categoria" class="form-select w-100">
                                    <option value="" selected>Seleccione una opción</option> <!-- Opción predeterminada -->
                                    @foreach($categorias as $c)
                                        <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            
                            
                            
                            <div class="mb-3">
                                <label for="burgerName" class="form-label">Nombre de la producto</label>
                                <input type="text" class="form-control" name="nombre_producto" id="burgerName" placeholder="Ingrese el nombre de la producto">
                            </div>
                            <div class="mb-3">
                                <label for="burgerName" class="form-label">Precio de la producto</label>
                                <input type="text" class="form-control" name="precio_producto" id="burgerName" placeholder="Ingrese el precio de la producto">
                            </div>
                            
                            <div class="mb-3">
                                <label for="burgerDescription" class="form-label">Descripción de la producto</label>
                                <textarea class="form-control" name="descripcion_producto" id="burgerDescription" rows="4" placeholder="Descripción detallada..."></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock del producto</label>
                                <input type="number" class="form-control" name="stock" id="stock" min="0" placeholder="Ingrese la cantidad disponible">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Características del producto</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="caracteristicas[]" value="nuevo" id="checkNuevo">
                                    <label class="form-check-label" for="checkNuevo">Producto Nuevo</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="caracteristicas[]" value="destacado" id="checkDestacado">
                                    <label class="form-check-label" for="checkDestacado">Producto Destacado</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="caracteristicas[]" value="oferta" id="checkOferta">
                                    <label class="form-check-label" for="checkOferta">En Oferta</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Disponibilidad</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="disponibilidad" type="radio" name="availability" id="availabilityYes" value="si">
                                    <label class="form-check-label" for="availabilityYes">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="disponibilidad" type="radio" name="availability" id="availabilityNo" value="no">
                                    <label class="form-check-label" for="availabilityNo">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Subir Imagen</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img id="burgerPreview" src="/api/placeholder/400/300" class="img-preview" alt="Previsualización">
                            </div>
                            <div class="mb-3">
                                <label for="burgerImage" class="form-label">Seleccionar Imagen</label>
                                <input class="form-control" name="imagen" type="file" id="burgerImage" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit">
                crear producto
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
