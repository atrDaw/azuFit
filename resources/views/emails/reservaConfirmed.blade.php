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
            border-top: 5px solid #4a908a;
        }

        .info-box {
            background-color: #e8f5f4;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border: 1px solid #4a908a;
        }

        .btn {
            background-color: #4a908a;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>¡Reserva Confirmada! ✅</h1>
        <p>Hola {{ $reserva->user->name }},</p>
        <p>Buenas noticias: tu solicitud para la sesión en directo ha sido aceptada.</p>

        <div class="info-box">
            <h3 style="margin-top: 0; color: #4a908a;">{{ $reserva->sesion->titulo }}</h3>
            <p><strong>Disciplina:</strong> {{ $reserva->sesion->disciplina->nombre }}</p>
            <p><strong>Fecha:</strong> {{ $reserva->sesion->fecha_hora->format('d/m/Y') }}</p>
            <p><strong>Hora:</strong> {{ $reserva->sesion->fecha_hora->format('H:i') }}</p>
        </div>

        <p>Puedes acceder a la sala de videoconferencia a través del siguiente botón:</p>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $reserva->sesion->url_sesion }}" class="btn">Unirse a la Sesión</a>
        </div>

        <p style="font-size: 14px; color: #666;">Si no puedes asistir, por favor cancela tu reserva desde tu panel de usuario para liberar la plaza.</p>
    </div>
</body>

</html>