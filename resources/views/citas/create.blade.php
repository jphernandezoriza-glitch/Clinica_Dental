<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agendar Cita Dental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Agendar Nueva Cita</h4>
                    </div>
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('citas.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Paciente</label>
                                <select name="paciente_id" class="form-select" required>
                                    <option value="">-- Seleccionar Paciente --</option>
                                    @foreach($pacientes as $paciente)
                                        <option value="{{ $paciente->id }}">{{ $paciente->nombre }} ({{ $paciente->telefono }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Servicio Odontológico</label>
                                <select name="servicio_id" class="form-select" required>
                                    <option value="">-- Seleccionar Servicio --</option>
                                    @foreach($servicios as $servicio)
                                        <option value="{{ $servicio->id }}">{{ $servicio->nombre }} - ${{ number_format($servicio->precio, 2) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Fecha y Hora de Inicio</label>
                                    <input type="datetime-local" name="fecha_hora_inicio" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Fecha y Hora Estimada de Fin</label>
                                    <input type="datetime-local" name="fecha_hora_fin" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Observaciones (Opcional)</label>
                                <textarea name="observaciones" class="form-control" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-success w-100">Confirmar Cita</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>