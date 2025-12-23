@extends('layout')

@section('title','Iniciar Sesión - Azufit')

@section('content')

<div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="row justify-content-center w-100">
        <div class="col-12 col-md-8 col-lg-5 col-xl-4">

            <div class="card border-0 shadow-sm rounded-3 bg-white">
                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">
                        <h1 class="h3 fw-bold mb-1">¡Hola de nuevo!</h1>
                        <p class="small text-muted-color mb-0">Ingresa tus datos para continuar entrenando.</p>
                    </div>

                    @error('login_error')
                    <div class="alert alert-danger d-flex align-items-center gap-2 small rounded-3" role="alert">
                        <span class="material-symbols-outlined" style="font-size: 18px;">error</span>
                        {{ $message }}
                    </div>
                    @enderror

                    <form action="{{route('login')}}" method="post" class="needs-validation" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label small fw-bold text-muted-color">Correo Electrónico</label>
                            <input type="email" name='email' class="form-control rounded-3 py-2" id="email" placeholder="ejemplo@correo.com" value="{{old('email')}}" required>
                            <div class="invalid-feedback">
                                Por favor introduce un correo válido.
                            </div>
                            @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="password" class="form-label small fw-bold text-muted-color">Contraseña</label>
                            </div>
                            <input type="password" name='password' class="form-control rounded-3 py-2" id="password" placeholder="••••••••" required>
                            <div class="invalid-feedback">
                                Por favor introduce tu contraseña.
                            </div>
                        </div>

                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="rememberCheck">
                            <label class="form-check-label small text-muted-color" for="rememberCheck">
                                Mantener sesión iniciada
                            </label>
                        </div>

                        <div class="d-grid mb-4">
                            <button class="btn btn-primary rounded-3 py-2 fw-bold shadow-sm" type="submit">
                                Iniciar Sesión
                            </button>
                        </div>

                        <div class="text-center">
                            <p class="small text-muted-color mb-0">
                                ¿Aún no tienes cuenta?
                                <a href="{{route('signup')}}" class="text-primary-color fw-bold text-decoration-none hover-link">
                                    Regístrate aquí
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{route('home')}}" class="small text-muted-color text-decoration-none d-flex align-items-center justify-content-center gap-1">
                    <span class="material-symbols-outlined" style="font-size: 16px;">arrow_back</span>
                    Volver al inicio
                </a>
            </div>

        </div>
    </div>
</div>

<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
@endsection