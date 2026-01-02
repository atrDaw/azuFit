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
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .btn {
            background-color: #4a908a;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }

        h1 {
            color: #333;
        }

        p {
            color: #555;
            line-height: 1.6;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>¡Hola, {{ $user->name }}! 👋</h1>
        <p>Estamos muy felices de que te hayas unido a <strong>Azufit</strong>.</p>
        <p>A partir de ahora tienes acceso a nuestro catálogo de clases grabadas y puedes solicitar sesiones privadas en directo.</p>
        <p>Tu camino hacia una vida más saludable empieza hoy.</p>

        <div style="text-align: center;">
            <a href="{{ route('login') }}" class="btn">Entrar a mi cuenta</a>
        </div>

        <p style="margin-top: 30px; font-size: 12px; color: #999;">Si no te has registrado tú, ignora este correo.</p>
    </div>
</body>

</html>