@extends('layout')

@section('title', __('Programar Sesión - Azufit'))

@section('content')
<div class="container d-flex align-items-center justify-content-center main-container-centered mt-1">
    <div class="row justify-content-center w-100">
        <div class="col-12 col-md-10 col-lg-8 col-xl-6">

            <div class="card border-0 shadow-sm rounded-3 bg-white">
                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">
                        <h1 class="h3 fw-bold mb-1">{{ __('Programar Directo') }}</h1>
                        <p class="small text-muted-color mb-0">{{ __('Añade una nueva sesión en vivo al calendario.') }}</p>
                    </div>

                    <form class="needs-validation" novalidate action="{{ route('sesiones.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="titulo" class="form-label small fw-bold text-muted-color">{{ __('Título de la Sesión') }}</label>
                            <input type="text" class="form-control rounded-3 py-2" id="titulo" name="titulo" value="{{ old('titulo') }}" placeholder="{{ __('Ej: Yoga al Amanecer') }}" required>
                            <div class="invalid-feedback">{{ __('Introduce un título para la sesión.') }}</div>
                            @error('titulo') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="disciplina_id" class="form-label small fw-bold text-muted-color">{{ __('Disciplina') }}</label>
                            <select class="form-select rounded-3 py-2" id="disciplina_id" name="disciplina_id" required>
                                <option value="" selected disabled>{{ __('Seleccionar...') }}</option>
                                @foreach($disciplinas as $disciplina)
                                <option value="{{ $disciplina->id }}" {{ old('disciplina_id') == $disciplina->id ? 'selected' : '' }}>
                                    {{ $disciplina->nombre }}
                                </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ __('Selecciona una disciplina.') }}</div>
                            @error('disciplina_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="fecha" class="form-label small fw-bold text-muted-color">{{ __('Fecha') }}</label>
                                <input type="date" class="form-control rounded-3 py-2" id="fecha" name="fecha" value="{{ old('fecha') }}" required min="{{ date('Y-m-d') }}">
                                <div class="invalid-feedback">{{ __('Selecciona una fecha válida.') }}</div>
                                @error('fecha') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="hora" class="form-label small fw-bold text-muted-color">{{ __('Hora') }}</label>
                                <input type="time" class="form-control rounded-3 py-2" id="hora" name="hora" value="{{ old('hora') }}" required>
                                <div class="invalid-feedback">{{ __('Selecciona una hora.') }}</div>
                                @error('hora') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="url_sesion" class="form-label small fw-bold text-muted-color">{{ __('Enlace de la Reunión (Zoom/Meet)') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><span class="material-symbols-outlined" style="font-size: 18px;">link</span></span>
                                <input type="url" class="form-control rounded-end-3 py-2 border-start-0 ps-0" id="url_sesion" name="url_sesion" value="{{ old('url_sesion') }}" placeholder="https://zoom.us/j/..." >
                                <div class="invalid-feedback">{{ __('Introduce una URL válida para la videollamada.') }}</div>
                            </div>
                            <div class="form-text small mt-1">{{ __('Este enlace se enviará a los usuarios que reserven.') }}</div>
                            @error('url_sesion') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-grid mb-4">
                            <button class="btn btn-primary rounded-3 py-2 fw-bold shadow-sm" type="submit">
                                {{ __('Publicar Sesión') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <div class="text-center my-3">
                <a href="{{ route('sesiones.index') }}" class="small text-muted-color text-decoration-none d-flex align-items-center justify-content-center gap-1">
                    <span class="material-symbols-outlined" style="font-size: 16px;">arrow_back</span>
                    {{ __('Volver al calendario') }}
                </a>
            </div>

        </div>
    </div>
</div>

<script>
    // Validación Bootstrap
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            Array.prototype.filter.call(forms, function(form) {
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