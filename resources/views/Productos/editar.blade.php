@extends('adminlte::page')

@section('title', 'Editar producto')

@section('content_header')
    <h1>Editar producto</h1>
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
            <h4>Editar producto: {{ $producto->nombre }}</h4>
            <div>
                <a href="{{ url('lista-productos') }}" class="btn btn-outline-secondary me-2">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
                <button form="formEditarproducto" type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar Cambios
                </button>
            </div>
        </div>
        
        <form id="formEditarproducto" method="POST" action="{{ url('actualizar-producto/' . $producto->id) }}" enctype="multipart/form-data">
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
                                <label for="categoria" class="form-label">Categoría</label>
                                <select name="id_categoria" id="categoria" class="form-select">
                                    <option value="">Seleccione una opción</option> <!-- Opción predeterminada -->
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" 
                                            {{ $producto->id_categoria == $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_categoria')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="burgerName" class="form-label">Nombre de la producto</label>
                                <input type="text" class="form-control" name="Nombre" id="burgerName" 
                                       value="{{ $producto->nombre }}" placeholder="Ingrese el nombre de la producto">
                                @error('Nombre')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="burgerPrice" class="form-label">Precio de la producto</label>
                                <input type="text" class="form-control" name="precio" id="burgerPrice" 
                                       value="{{ $producto->precio }}" placeholder="Ingrese el precio de la producto">
                                @error('precio')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="burgerDescription" class="form-label">Descripción de la producto</label>
                                <textarea class="form-control" name="descripcion" id="burgerDescription" 
                                          rows="4" placeholder="Descripción detallada...">{{ $producto->descripcion }}</textarea>
                                @error('descripcion')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Disponibilidad</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="disponible" 
                                           id="availabilityYes" value="si" {{ $producto->disponible == 'si' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="availabilityYes">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="disponible" 
                                           id="availabilityNo" value="no" {{ $producto->disponible == 'no' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="availabilityNo">No</label>
                                </div>
                                @error('disponible')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Imagen Actual</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img id="burgerPreview" 
                                     src="{{ asset('storage/' . $producto->imagen) }}" 
                                     class="img-preview" 
                                     alt="{{ $producto->nombre }}">
                            </div>
                            <div class="mb-3">
                                <label for="burgerImage" class="form-label">Cambiar Imagen (opcional)</label>
                                <input class="form-control" name="imagen" type="file" id="burgerImage" accept="image/*">
                                <small class="form-text text-muted">Deja este campo vacío si no deseas cambiar la imagen actual.</small>
                                @error('imagen')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mt-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="card-title">Información Adicional</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>ID:</strong> {{ $producto->id }}</p>
                                    <p><strong>Creado:</strong> {{ date('d/m/Y H:i', strtotime($producto->created_at)) }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Última actualización:</strong> {{ date('d/m/Y H:i', strtotime($producto->updated_at)) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card bg-light">
                        <div class="card-body d-flex justify-content-between">
                            <a href="{{ url('lista-productos') }}" class="btn btn-secondary">
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