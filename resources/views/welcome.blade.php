<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Dental - Servicios y Citas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Encabezado / Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Clínica Dental</a>
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Acceso Administrativo</a>
        </div>
    </nav>

    <div class="container my-5">
        <!-- Promociones Especiales -->
        @if($promociones->count() > 0)
            <h2 class="mb-4 text-primary">Promociones Vigentes</h2>
            <div class="row g-4 mb-5">
                @foreach($promociones as $promo)
                    <div class="col-md-6">
                        <div class="card border-primary h-100 shadow-sm">
                            <div class="card-body">
                                <span class="badge bg-danger mb-2">¡Oferta Especial!</span>
                                <h4 class="card-title text-dark">{{ $promo->titulo }}</h4>
                                <p class="card-text text-muted">{{ $promo->descripcion }}</p>
                                <h3 class="text-success fw-bold">${{ number_format($promo->precio_promocional, 2) }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Catálogo de Servicios -->
        <h2 class="mb-4 text-primary">Nuestros Servicios</h2>
        <div class="row g-4">
            @foreach($servicios as $servicio)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $servicio->nombre }}</h5>
                            <p class="card-text text-muted flex-grow-1">{{ $servicio->descripcion }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fs-5 fw-bold text-primary">${{ number_format($servicio->precio, 2) }}</span>
                                <a href="{{ route('citas.create') }}" class="btn btn-primary btn-sm">Agendar Cita</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>