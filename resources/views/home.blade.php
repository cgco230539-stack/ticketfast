<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>TicketFast</title>
</head>
<body>

    @extends('layouts.app')
    @section('content')
<div class="container py-5">

    <!-- HERO -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-10">
            <div class="text-center mb-4">
                <h1 class="fw-bold display-4 mb-3">Bienvenido a TicketFast 🎟️</h1>
                <p class="text-muted fs-5 mx-auto" style="max-width: 720px;">
                    Descubre, gestiona y disfruta los mejores eventos desde un solo lugar.
                    Explora conciertos, festivales y experiencias inolvidables.
                </p>
            </div>

            <div class="position-relative rounded-4 overflow-hidden shadow">
                <img src="https://images.unsplash.com/photo-1507874457470-272b3c8d8ee2"
                     class="img-fluid w-100"
                     style="height: 360px; object-fit: cover;"
                     alt="Eventos en TicketFast">

                <div class="position-absolute top-50 start-50 translate-middle text-center text-white px-3">
                    <h2 class="fw-bold mb-3" style="text-shadow: 0 2px 10px rgba(0,0,0,.5);">
                        Vive la experiencia de tus eventos favoritos
                    </h2>
                    <p class="mb-0" style="text-shadow: 0 2px 10px rgba(0,0,0,.5);">
                        Compra, administra y consulta tus tickets fácilmente.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- CARDS PRINCIPALES -->
    <div class="row justify-content-center g-4">

        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-center">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="fs-1 mb-3">🎤</div>
                        <h3 class="fw-bold mb-3">Eventos</h3>
                        <p class="text-muted mb-4">
                            Explora conciertos, festivales y experiencias disponibles.
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('events.index') }}" class="btn btn-primary px-4 rounded-3">
                            Ver eventos
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @auth
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-center">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="fs-1 mb-3">🎟️</div>
                        <h3 class="fw-bold mb-3">Mis Tickets</h3>
                        <p class="text-muted mb-4">
                            Consulta tus boletos y compras realizadas dentro del sistema.
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('tickets.index') }}" class="btn btn-success px-4 rounded-3">
                            Ver mis tickets
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-center">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="fs-1 mb-3">📝</div>
                        <h3 class="fw-bold mb-3">Crear cuenta</h3>
                        <p class="text-muted mb-4">
                            Regístrate para comprar tickets y acceder al sistema.
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('registro') }}" class="btn btn-success px-4 rounded-3">
                            Registrarse
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endauth

        @auth
            @if(auth()->user()->is_admin)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 text-center">
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <div class="fs-1 mb-3">⚙️</div>
                            <h3 class="fw-bold mb-3">Administración</h3>
                            <p class="text-muted mb-4">
                                Gestiona usuarios, administradores y el panel del sistema.
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-dark px-4 rounded-3">
                                Ir al panel admin
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endauth

    </div>

    @auth
        @if(auth()->user()->is_admin)
        <div class="row justify-content-center g-4 mt-3">

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 text-center">
                    <div class="card-body p-4">
                        <div class="fs-1 mb-3">👥</div>
                        <h4 class="fw-bold mb-3">Usuarios</h4>
                        <p class="text-muted mb-4">
                            Consulta y administra los usuarios registrados.
                        </p>
                        <a href="{{ route('users.index') }}" class="btn btn-outline-primary rounded-3">
                            Ver usuarios
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 text-center">
                    <div class="card-body p-4">
                        <div class="fs-1 mb-3">🛡️</div>
                        <h4 class="fw-bold mb-3">Admins</h4>
                        <p class="text-muted mb-4">
                            Consulta la lista actual de administradores.
                        </p>
                        <a href="{{ route('admins.index') }}" class="btn btn-outline-dark rounded-3">
                            Lista admins
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 text-center">
                    <div class="card-body p-4">
                        <div class="fs-1 mb-3">➕</div>
                        <h4 class="fw-bold mb-3">Nuevo admin</h4>
                        <p class="text-muted mb-4">
                            Registra un nuevo usuario administrador.
                        </p>
                        <a href="{{ route('admin.create') }}" class="btn btn-outline-success rounded-3">
                            Registrar admin
                        </a>
                    </div>
                </div>
            </div>

        </div>
        @endif
    @endauth

</div>
@endsection


</body>
</html>
