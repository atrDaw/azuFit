@extends('layout')

@section('title', __('Registro - Azufit'))

@section('content')

<div class="container d-flex align-items-center justify-content-center main-container-centered mt-3">
    <div class="row justify-content-center w-100">
        <div class="col-12 col-md-10 col-lg-8 col-xl-6">

            <div class="card border-0 shadow-sm rounded-3 bg-white">
                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">
                        <h1 class="h3 fw-bold mb-1">{{ __('Crea tu cuenta') }}</h1>
                        <p class="small text-muted-color mb-0">{{ __('Únete a la comunidad Azufit y empieza tu transformación.') }}</p>
                    </div>

                    <form class="needs-validation" novalidate action="{{route('signup')}}" method="post">
                        @csrf

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label small fw-bold text-muted-color">{{ __('Nombre') }}</label>
                                <input type="text" name="name" class="form-control rounded-3 py-2" id="validationCustom01" placeholder="{{ __('Ej: Rick') }}" value="{{ old('name') }}" required>
                                <div class="invalid-feedback">{{ __('Por favor introduce tu nombre.') }}</div>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom02" class="form-label small fw-bold text-muted-color">{{ __('Apellido') }}</label>
                                <input type="text" name="surname" class="form-control rounded-3 py-2" id="validationCustom02" placeholder="{{ __('Ej: Sánchez') }}" value="{{ old('surname') }}" required>
                                <div class="invalid-feedback">{{ __('Por favor introduce tu apellido.') }}</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="validationCustom03" class="form-label small fw-bold text-muted-color">{{ __('Correo Electrónico') }}</label>
                            <input type="email" name="email" class="form-control rounded-3 py-2" id="validationCustom03" placeholder="{{ __('ejemplo@correo.com') }}" value="{{ old('email') }}" required>
                            <div class="invalid-feedback">{{ __('Por favor introduce un correo válido.') }}</div>
                            @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="validationCustom04" class="form-label small fw-bold text-muted-color">{{ __('Contraseña') }}</label>
                                <input type="password" name="password" class="form-control rounded-3 py-2" id="validationCustom04" placeholder="••••••••" required>
                                <div class="invalid-feedback">{{ __('Introduce una contraseña válida.') }}</div>
                                @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom05" class="form-label small fw-bold text-muted-color">{{ __('Repetir contraseña') }}</label>
                                <input type="password" name="password_confirmation" class="form-control rounded-3 py-2" id="validationCustom05" placeholder="••••••••" required>
                                <div class="invalid-feedback">{{ __('Las contraseñas no coinciden.') }}</div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch ps-0">
                                <div class="d-flex align-items-center gap-2">
                                    <input class="form-check-input ms-0" type="checkbox" name="is_student" value="1" id="isStudentCheck" {{ old('is_student') ? 'checked' : '' }} >
                                    
                                    <label class="form-check-label small text-muted-color" for="isStudentCheck" style="cursor: pointer; user-select: none;">
                                        {{ __('Soy estudiante') }} 
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid mb-4">
                            <button class="btn btn-primary rounded-3 py-2 fw-bold shadow-sm" type="submit">
                                {{ __('Registrarme') }}
                            </button>
                        </div>

                        <div class="text-center">
                            <p class="small text-muted-color mb-0">
                                {{ __('¿Ya tienes una cuenta?') }}
                                <a href="{{route('login')}}" class="text-primary-color fw-bold text-decoration-none hover-link">
                                    {{ __('Inicia sesión aquí') }}
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{route('home')}}" class="small text-muted-color text-decoration-none d-flex align-items-center justify-content-center gap-1">
                    <span class="material-symbols-outlined" style="font-size: 16px;">arrow_back</span>
                    {{ __('Volver al inicio') }}
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