<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" rel="stylesheet" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet" />
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</head>

<body>
    <div class="d-flex flex-column min-vh-100">

        <header class="sticky-top">@include('partials.header')</header>

        <main>@yield('content')</main>

        <footer>@include('partials.footer')</footer>

    </div>


    @if (session('success') || session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Genial!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
            @endif

            @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: '¡Ups!',
                text: "{{ session('error') }}",
                showConfirmButton: true
            });
            @endif

        });
    </script>
    @endif
</body>

</html>