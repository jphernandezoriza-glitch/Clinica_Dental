<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Citas - Panel Dental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gestión de Citas Agendadas</h2>
            <a href="{{ route('citas.create') }}" class="btn btn-primary">+ Agendar Nueva Cita</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Paciente</th>
                            <th>Servicio</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($citas as $cita)
                            <tr>
                                <td>{{ $cita->id }}</td>
                                <td>{{ $cita->paciente->nombre }}</td>
                                <td>{{ $cita->servicio->nombre }}</td>
                                <td>{{ \Carbon\Carbon::parse($cita->fecha_hora_inicio)->format('d/m/Y H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($cita->fecha_hora_fin)->format('d/m/Y H:i') }}</td>
                                <td>
                                    <span class="badge bg-{{ $cita->estado === 'confirmada' ? 'success' : ($cita->estado === 'cancelada' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($cita->estado) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No hay citas registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>