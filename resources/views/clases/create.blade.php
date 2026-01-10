@extends('layout')

@section('title', __('Nueva Clase - Azufit'))

@section('content')
<div class="container d-flex align-items-center justify-content-center main-container-centered mt-1">
    <div class="row justify-content-center w-100">
        <div class="col-12 col-md-10 col-lg-8 col-xl-6">

            <div class="card border-0 shadow-sm rounded-3 bg-white">
                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">
                        <h1 class="h3 fw-bold mb-1">{{ __('Nueva Clase') }}</h1>
                        <p class="small text-muted-color mb-0">{{ __('Añade una nueva sesión a la plataforma Azufit.') }}</p>
                    </div>

                    <form class="needs-validation" novalidate action="{{ route('clases.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf


                        <div class="mb-3">
                            <label for="titulo" class="form-label small fw-bold text-muted-color">{{ __('Título de la Clase') }}</label>
                            <input type="text" class="form-control rounded-3 py-2" id="titulo" name="titulo" value="{{ old('titulo') }}" placeholder="{{ __('Ej: Pilates Mañanero') }}" required>
                            <div class="invalid-feedback">{{ __('Por favor introduce un título.') }}</div>
                            @error('titulo')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-3">

                            <div class="col-md-6">
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
                                @error('disciplina_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="nivel" class="form-label small fw-bold text-muted-color">{{ __('Nivel') }}</label>
                                <select class="form-select rounded-3 py-2" id="nivel" name="nivel" required>
                                    <option value="" selected disabled>{{ __('Seleccionar...') }}</option>
                                    <option value="Principiante" {{ old('nivel') == 'Principiante' ? 'selected' : '' }}>{{ __('Principiante') }}</option>
                                    <option value="Intermedio" {{ old('nivel') == 'Intermedio' ? 'selected' : '' }}>{{ __('Intermedio') }}</option>
                                    <option value="Avanzado" {{ old('nivel') == 'Avanzado' ? 'selected' : '' }}>{{ __('Avanzado') }}</option>
                                </select>
                                <div class="invalid-feedback">{{ __('Selecciona un nivel.') }}</div>
                                @error('nivel')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label small fw-bold text-muted-color">{{ __('Descripción') }}</label>
                            <textarea class="form-control rounded-3 py-2" id="descripcion" name="descripcion" rows="3" placeholder="{{ __('Describe brevemente la sesión...') }}" required>{{ old('descripcion') }}</textarea>
                            <div class="invalid-feedback">{{ __('Añade una descripción.') }}</div>
                            @error('descripcion')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted-color d-block mb-2">{{ __('Contenido de la Clase') }}</label>

                            <div class="p-3 bg-light rounded-3 border-0">

                                <div class="d-flex gap-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="video_source" id="source_url" value="url" checked onclick="toggleVideoInput('url')">
                                        <label class="form-check-label small text-muted-color" for="source_url" style="cursor: pointer;">
                                            {{ __('Enlace YouTube') }}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="video_source" id="source_file" value="file" onclick="toggleVideoInput('file')">
                                        <label class="form-check-label small text-muted-color" for="source_file" style="cursor: pointer;">
                                            {{ __('Subir Archivo') }}
                                        </label>
                                    </div>
                                </div>


                                <div id="input_url_container">
                                    <input class="form-control rounded-3 py-2" type="url" name="url_video" id="url_video" value="{{ old('url_video') }}" placeholder="https://youtube.com/...">
                                    <div class="invalid-feedback">
                                        {{ __('Por favor, introduce una URL válida de YouTube.') }}
                                    </div>
                                    @error('url_video') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>


                                <div id="input_file_container" class="d-none">
                                    <input class="form-control rounded-3 py-2" type="file" name="video_file" id="video_file" accept="video/*">
                                    <div class="form-text small mt-1">{{ __('Formatos: MP4, WebM') }}</div>
                                    <div class="invalid-feedback">
                                        {{ __('Selecciona un archivo') }}
                                    </div>
                                    @error('video_file') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-grid mb-4">
                            <button class="btn btn-primary rounded-3 py-2 fw-bold shadow-sm" type="submit">
                                {{ __('Guardar Clase') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <div class="text-center my-3">
                <a href="{{ route('clases.index') }}" class="small text-muted-color text-decoration-none d-flex align-items-center justify-content-center gap-1">
                    <span class="material-symbols-outlined" style="font-size: 16px;">arrow_back</span>
                    {{ __('Volver al listado') }}
                </a>
            </div>

        </div>
    </div>
</div>

<script>
    function toggleVideoInput(source) {
        const urlContainer = document.getElementById('input_url_container');
        const fileContainer = document.getElementById('input_file_container');
        const urlInput = document.getElementById('url_video');
        const fileInput = document.getElementById('video_file');

        if (source === 'url') {
            urlContainer.classList.remove('d-none');
            fileContainer.classList.add('d-none');
            fileInput.value = '';
        } else {
            urlContainer.classList.add('d-none');
            fileContainer.classList.remove('d-none');
            urlInput.value = '';
        }
    }

   (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');

            const MAX_SIZE_MB = 100;
            const MAX_SIZE_BYTES = MAX_SIZE_MB * 1024 * 1024;
            const ALLOWED_TYPES = ['video/mp4', 'video/webm', 'video/ogg'];

            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {

                    const videoSource = document.querySelector('input[name="video_source"]:checked').value;
                    const urlInput = document.getElementById('url_video');
                    const fileInput = document.getElementById('video_file');

                    const fileFeedbackDiv = fileInput.parentElement.querySelector('.invalid-feedback');
                    const defaultFileMsg = "{{ __('Selecciona un archivo válido.') }}";

                    urlInput.setCustomValidity('');
                    fileInput.setCustomValidity('');
                    if (fileFeedbackDiv) fileFeedbackDiv.textContent = defaultFileMsg;

                    if (videoSource === 'url') {
                        if (!urlInput.value) {
                            urlInput.setCustomValidity("{{ __('Introduce una URL válida') }}");
                        }
                    } 
                    else if (videoSource === 'file') {
                        if (fileInput.files.length === 0) {
                            fileInput.setCustomValidity("{{ __('Selecciona un archivo.') }}");
                        } 
                        else {
                            const file = fileInput.files[0];

                            if (file.size > MAX_SIZE_BYTES) {
                                const sizeMsg = "{{ __('El archivo supera el límite de ') }}" + MAX_SIZE_MB + "MB.";
                                fileInput.setCustomValidity(sizeMsg);
                                fileFeedbackDiv.textContent = sizeMsg; 
                            } 
                            else if (!ALLOWED_TYPES.includes(file.type)) {
                                const typeMsg = "{{ __('Formato no válido. Usa MP4, WebM o Ogg.') }}";
                                fileInput.setCustomValidity(typeMsg);
                                fileFeedbackDiv.textContent = typeMsg; 
                            }
                        }
                    }

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