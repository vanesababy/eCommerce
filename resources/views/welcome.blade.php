<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fuego Burger - De barrio pero elegante</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <h2>FUEGO BURGER</h2>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#burgerModal">Hamburguesas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Combos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Acompañantes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sedes</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a class="btn btn-primary me-2" href="{{ url('/login')}}">
                        <i class="bi bi-cart"></i> Ordenar Ahora
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-4 fw-bold">DE BARRIO PERO ELEGANTE</h1>
                    <p class="lead">Las mejores hamburguesas artesanales con el sabor único del barrio y la elegancia que te mereces.</p>
                    <button class="btn btn-primary btn-lg">Ver Menú</button>
                </div>
                <div class="col-md-6">
                    <img src="/api/placeholder/600/400" alt="Hamburguesa Premium" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4 section-title">Nuestro Menú</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card">
                        <img src="/api/placeholder/400/300" class="card-img-top" alt="Hamburguesas">
                        <div class="card-body text-center">
                            <h5 class="card-title">Hamburguesas</h5>
                            <p>Las mejores hamburguesas artesanales</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="/api/placeholder/400/300" class="card-img-top" alt="Combos">
                        <div class="card-body text-center">
                            <h5 class="card-title">Combos</h5>
                            <p>Combos especiales para todos los gustos</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="/api/placeholder/400/300" class="card-img-top" alt="Acompañantes">
                        <div class="card-body text-center">
                            <h5 class="card-title">Acompañantes</h5>
                            <p>El complemento perfecto para tu hamburguesa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="burgerModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content" >
                    <div class="modal-header">
                        <h5 class="modal-title">Menú de Hamburguesas</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-0" >
                        <div class="d-flex" >
                            <!-- Lista de hamburguesas -->
                            <div class="burger-list">
                                <div class="burger-item active">
                                    <h5>LA W</h5>
                                    <small>La hamburguesa más vendida</small>
                                </div>
                                <div class="burger-item">
                                    <h5>LA FIRE</h5>
                                    <small>Para los amantes del picante</small>
                                </div>
                                <div class="burger-item">
                                    <h5>LA CHEESE</h5>
                                    <small>Explosión de quesos</small>
                                </div>
                            </div>
                            
                            <!-- Imagen de hamburguesa -->
                            <div class="burger-image-section">
                                <div class="burger-image-container">
                                    {{-- <img src="/api/placeholder/400/400" class="burger-image" alt="LA W Burger">
                                    <span class="ingredient-label" style="top: 10%; left: 15%;">QUESO</span>
                                    <span class="ingredient-label" style="top: 20%; right: 15%;">TOCINETA</span>
                                    <span class="ingredient-label" style="top: 40%; left: 10%;">POLLO</span>
                                    <span class="ingredient-label" style="top: 60%; right: 20%;">CARNE</span>
                                    <span class="ingredient-label" style="bottom: 30%; left: 20%;">LECHUGA</span>
                                    <span class="ingredient-label" style="bottom: 20%; right: 15%;">TOMATE</span> --}}
                                </div>
                            </div>
                            
                            <!-- Detalles y opciones -->
                            <div class="burger-details">
                                <div class="burger-details-wrapper">
                                    <div class="details-content">
                                        <h2>LA W</h2>
                                        <p class="lead">Nuestra hamburguesa insignia con doble carne, pollo crispy, 
                                           tocineta, queso cheddar, lechuga fresca y tomate.</p>
                                    </div>
                                    
                                    <div class="addon-section">
                                        <h4>Adiciones</h4>
                                        <div class="addon-item">
                                            <input type="checkbox" id="addon1">
                                            <label for="addon1">Tocineta Extra</label>
                                            <span class="addon-price">+$3.99</span>
                                        </div>
                                        <div class="addon-item">
                                            <input type="checkbox" id="addon2">
                                            <label for="addon2">Queso Adicional</label>
                                            <span class="addon-price">+$2.99</span>
                                        </div>
                                        <div class="addon-item">
                                            <input type="checkbox" id="addon3">
                                            <label for="addon3">Cebolla Caramelizada</label>
                                            <span class="addon-price">+$1.99</span>
                                        </div>
                                    </div>
                                    
                                    <div class="addon-section">
                                        <h4>Acompañantes</h4>
                                        <div class="addon-item">
                                            <input type="checkbox" id="side1">
                                            <label for="side1">Papas Fritas</label>
                                            <span class="addon-price">+$4.99</span>
                                        </div>
                                        <div class="addon-item">
                                            <input type="checkbox" id="side2">
                                            <label for="side2">Aros de Cebolla</label>
                                            <span class="addon-price">+$5.99</span>
                                        </div>
                                    </div>
                                    
                                    <div class="instructions-section">
                                        <h4>Instrucciones Adicionales</h4>
                                        <textarea class="instructions" placeholder="Ej: Sin cebolla, salsa aparte, etc."></textarea>
                                    </div>
                                    
                                    <div class="price-tag">
                                        Total: $18.99
                                    </div>
                                    
                                    <button class="order-button">PEDIR AHORA</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-5" style="background-color: var(--light-black)">
        <div class="container">
            <h2 class="text-center mb-4 section-title">Los Más Populares</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card product-card">
                        <img src="/api/placeholder/300/300" class="card-img-top" alt="Hamburguesa Clásica">
                        <div class="card-body">
                            <h5 class="card-title">Hamburguesa Clásica</h5>
                            <p class="price">$15.99</p>
                            <button class="btn btn-primary w-100">Ordenar Ahora</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card product-card">
                        <img src="/api/placeholder/300/300" class="card-img-top" alt="Combo Familiar">
                        <div class="card-body">
                            <h5 class="card-title">Combo Familiar</h5>
                            <p class="price">$39.99</p>
                            <button class="btn btn-primary w-100">Ordenar Ahora</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card product-card">
                        <img src="/api/placeholder/300/300" class="card-img-top" alt="Papas Supremas">
                        <div class="card-body">
                            <h5 class="card-title">Papas Supremas</h5>
                            <p class="price">$8.99</p>
                            <button class="btn btn-primary w-100">Ordenar Ahora</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card product-card">
                        <img src="/api/placeholder/300/300" class="card-img-top" alt="Hamburguesa Especial">
                        <div class="card-body">
                            <h5 class="card-title">Hamburguesa Especial</h5>
                            <p class="price">$19.99</p>
                            <button class="btn btn-primary w-100">Ordenar Ahora</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Locations -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4 section-title">Nuestras Sedes</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Sede Norte</h5>
                            <p>Dirección: Calle 123 #45-67</p>
                            <p>Tel: (123) 456-7890</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Sede Sur</h5>
                            <p>Dirección: Calle 789 #12-34</p>
                            <p>Tel: (123) 456-7891</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Sede Este</h5>
                            <p>Dirección: Calle 456 #78-90</p>
                            <p>Tel: (123) 456-7892</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Sede Oeste</h5>
                            <p>Dirección: Calle 901 #23-45</p>
                            <p>Tel: (123) 456-7893</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Delivery -->
    <section class="py-5" style="background-color: var(--light-black)">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-8">
                    <h3 class="section-title">¡Pide a Domicilio o Recoge en Tienda!</h3>
                    <p class="lead">Disfruta de nuestras deliciosas hamburguesas donde prefieras</p>
                    <div class="mt-4">
                        <button class="btn btn-primary btn-lg me-3">Pedir Domicilio</button>
                        <button class="btn btn-outline-light btn-lg">Recoger en Tienda</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>FUEGO BURGER</h5>
                    <p>De barrio pero elegante</p>
                </div>
                <div class="col-md-4">
                    <h5>Horario</h5>
                    <p>Lunes a Domingo<br>12:00 PM - 10:00 PM</p>
                </div>
                <div class="col-md-4">
                    <h5>Contacto</h5>
                    <p>Línea de Atención: (123) 456-7890<br>
                    Email: info@fuegoburger.com</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>