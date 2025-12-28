@extends('layout')

@section('title', $clase->titulo . ' - Azufit')

@section('content')
<div class="container mt-4 mb-5">

    {{-- Navegación superior (Breadcrumb simple) --}}
    <div class="mb-3">
        <a href="{{ route('clases.index') }}" class="text-decoration-none text-muted small d-inline-flex align-items-center gap-1">
            <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
            Volver a Clases
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- Tarjeta Principal --}}
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">

                {{-- SECCIÓN DE VIDEO --}}
                <div class="ratio ratio-16x9 bg-dark">
                    @if($clase->es_local)
                    {{-- Reproductor Nativo (Archivo Local) --}}
                    <video controls controlsList="nodownload" class="w-100 h-100 object-fit-cover">
                        <source src="{{ asset($clase->video_embed) }}" type="video/mp4">
                        Tu navegador no soporta la reproducción de video.
                    </video>
                    @else
                    {{-- Iframe (YouTube / Externo) --}}
                    <iframe src="{{ $clase->video_embed }}"
                        title="Video player"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                    @endif
                </div>

                {{-- CUERPO DE LA TARJETA --}}
                <div class="card-body p-4 p-md-5">

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-3">
                        <div>
                            {{-- Badges / Etiquetas --}}
                            <div class="mb-2 d-flex gap-2">
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                                    {{ $clase->disciplina->nombre ?? 'General' }}
                                </span>

                                {{-- Lógica de colores según nivel --}}
                                @php
                                $nivelColor = match($clase->nivel) {
                                'Principiante' => 'success',
                                'Intermedio' => 'warning',
                                'Avanzado' => 'danger',
                                default => 'secondary'
                                };
                                @endphp
                                <span class="badge bg-{{ $nivelColor }} bg-opacity-10 text-{{ $nivelColor }} rounded-pill px-3 py-2">
                                    {{ $clase->nivel }}
                                </span>
                            </div>

                            <h1 class="fw-bold text-dark mb-1">{{ $clase->titulo }}</h1>
                            <p class="text-muted small mb-0">
                                Publicado el {{ $clase->created_at->format('d/m/Y') }}
                            </p>
                        </div>
                        
                        @auth
                        @if(auth()->user()->is_admin)
                        {{-- Botones de Acción (Editar/Borrar) --}}
                        <div class="d-flex gap-2">
                            <a href="{{ route('clases.edit', $clase->id) }}" class="btn btn-outline-secondary btn-sm rounded-3 d-flex align-items-center gap-1">
                                <span class="material-symbols-outlined" style="font-size: 18px;">edit</span>
                                Editar
                            </a>
                            {{-- Formulario para borrar --}}
                            <form action="{{ route('clases.destroy', $clase->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de borrar esta clase?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-3 d-flex align-items-center gap-1">
                                    <span class="material-symbols-outlined" style="font-size: 18px;">delete</span>
                                </button>
                            </form>
                        </div>
                        @endif
                        @endauth
                    </div>

                    <hr class="text-muted opacity-25 my-4">

                    {{-- Descripción --}}
                    <div class="mb-4">
                        <h5 class="fw-bold text-dark mb-3">Sobre esta sesión</h5>
                        <div class="text-muted lh-lg" style="white-space: pre-line;">
                            {{ $clase->descripcion }}
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection