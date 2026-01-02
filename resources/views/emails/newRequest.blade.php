<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 600px;
            margin: 0 auto;
            border-left: 5px solid #ffcba4;
        }

        .data-box {
            background-color: #f1f1f1;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }

        .btn {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>🔔 Nueva Solicitud de Reserva</h2>
        <p>Hola Admin, un alumno ha solicitado una sesión en directo.</p>

        <div class="data-box">
            <p><strong>Alumno:</strong> {{ $reserva->user->name }} {{ $reserva->user->surname }}</p>
            <p><strong>Email:</strong> {{ $reserva->user->email }}</p>
            <hr style="border: 0; border-top: 1px solid #ddd;">
            <p><strong>Clase:</strong> {{ $reserva->sesion->titulo }} ({{ $reserva->sesion->disciplina->nombre }})</p>
            <p><strong>Fecha:</strong> {{ $reserva->sesion->fecha_hora->format('d/m/Y H:i') }}</p>
        </div>

        <p>Por favor, entra al panel para aceptar o rechazar la solicitud.</p>

        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('admin.reservas.index') }}" class="btn">Gestionar Solicitudes</a>
        </div>
    </div>
</body>

</html>