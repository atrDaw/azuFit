@extends('layout')

@section('title', __('Editar Sesión - Azufit'))

@section('content')
<div class="container d-flex align-items-center justify-content-center main-container-centered mt-1">
    <div class="row justify-content-center w-100">
        <div class="col-12 col-md-10 col-lg-8 col-xl-6">

            <div class="card border-0 shadow-sm rounded-3 bg-white">
                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">
                        <h1 class="h3 fw-bold mb-1">{{ __('Editar Sesión') }}</h1>
                        <p class="small text-muted-color mb-0">{{ __('Modifica los detalles del directo programado.') }}</p>
                    </div>

                    <form class="needs-validation" novalidate action="{{ route('sesiones.update', $sesion->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="titulo" class="form-label small fw-bold text-muted-color">{{ __('Título de la Sesión') }}</label>
                            <input type="text" class="form-control rounded-3 py-2" id="titulo" name="titulo" value="{{ old('titulo', $sesion->titulo) }}" required>
                            <div class="invalid-feedback">{{ __('Introduce un título.') }}</div>
                            @error('titulo') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="disciplina_id" class="form-label small fw-bold text-muted-color">{{ __('Disciplina') }}</label>
                            <select class="form-select rounded-3 py-2" id="disciplina_id" name="disciplina_id" required>
                                <option value="" disabled>{{ __('Seleccionar...') }}</option>
                                @foreach($disciplinas as $disciplina)
                                <option value="{{ $disciplina->id }}" {{ old('disciplina_id', $sesion->disciplina_id) == $disciplina->id ? 'selected' : '' }}>
                                    {{ $disciplina->nombre }}
                                </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ __('Selecciona una disciplina.') }}</div>
                            @error('disciplina_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        @php
                            $fechaActual = \Carbon\Carbon::parse($sesion->fecha_hora)->format('Y-m-d');
                            $horaActual = \Carbon\Carbon::parse($sesion->fecha_hora)->format('H:i');
                        @endphp

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="fecha" class="form-label small fw-bold text-muted-color">{{ __('Fecha') }}</label>
                                <input type="date" class="form-control rounded-3 py-2" id="fecha" name="fecha" value="{{ old('fecha', $fechaActual) }}" required>
                                <div class="invalid-feedback">{{ __('Selecciona una fecha válida.') }}</div>
                                @error('fecha') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="hora" class="form-label small fw-bold text-muted-color">{{ __('Hora') }}</label>
                                <input type="time" class="form-control rounded-3 py-2" id="hora" name="hora" value="{{ old('hora', $horaActual) }}" required>
                                <div class="invalid-feedback">{{ __('Selecciona una hora.') }}</div>
                                @error('hora') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="url_sesion" class="form-label small fw-bold text-muted-color">{{ __('Enlace de la Reunión (Zoom/Meet)') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><span class="material-symbols-outlined" style="font-size: 18px;">link</span></span>
                                <input type="url" class="form-control rounded-end-3 py-2 border-start-0 ps-0" id="url_sesion" name="url_sesion" value="{{ old('url_sesion', $sesion->url_sesion) }}" placeholder="https://..." required>
                                <div class="invalid-feedback">{{ __('Introduce una URL válida.') }}</div>
                            </div>
                            @error('url_sesion') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-grid mb-4">
                            <button class="btn btn-primary rounded-3 py-2 fw-bold shadow-sm" type="submit">
                                {{ __('Guardar Cambios') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <div class="text-center my-3">
                <a href="{{ route('sesiones.index') }}" class="small text-muted-color text-decoration-none d-flex align-items-center justify-content-center gap-1">
                    <span class="material-symbols-outlined" style="font-size: 16px;">arrow_back</span>
                    {{ __('Cancelar y volver') }}
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