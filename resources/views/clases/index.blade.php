@extends('layout')

@section('title', 'Catálogo de Clases - Azufit')

@section('content')
<div class="container-fluid container-md py-5" style="min-height: 80vh;">


    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold mb-3">Catálogo de Clases Grabadas</h1>
        <p class="lead text-muted-color mx-auto" style="max-width: 700px;">
            Explora nuestra biblioteca de vídeos y entrena a tu ritmo desde cualquier lugar.
        </p>
    </div>


    <div class="row g-4">
        @forelse($clases as $clase)
        @php
        $imagen = match($clase->disciplina->nombre) {
        'Yoga' => asset('images/yoga.png'),
        'Pilates' => asset('images/pilates.png'),
        'Estiramientos' => asset('images/estiramientos.png'),
        };
        @endphp

        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-1 rounded-3 overflow-hidden card-hover-shadow transition-all">


                <div class="card-img-top position-relative" style="height: 200px;">

                    <img src="{{ $imagen }}"
                        alt="Clase de {{ $clase->disciplina->nombre }}"
                        class="w-100 h-100"
                        style="object-fit: cover;">


                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge rounded-pill 
                                @if($clase->nivel == 'Principiante') bg-success 
                                @elseif($clase->nivel == 'Intermedio') bg-warning text-dark 
                                @else bg-danger @endif">
                            {{ $clase->nivel }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-4 d-flex flex-column">
                    <div class="mb-2">
                        <span class="text-primary-color fw-bold small text-uppercase tracking-wide">
                            {{ $clase->disciplina->nombre }}
                        </span>
                    </div>

                    <h3 class="h5 fw-bold mb-2 text-dark">{{ $clase->titulo }}</h3>

                    <p class="card-text text-muted-color small mb-4 flex-grow-1">
                        {{ Str::limit($clase->descripcion, 100) }}
                    </p>

                    <div class="mt-auto pt-3 border-top border-light">
                        @auth
                        <a href="{{ route('clases.show', $clase->id) }}" class="btn btn-primary w-100 rounded-3 fw-bold d-flex align-items-center justify-content-center gap-2">
                            <span class="material-symbols-outlined" style="font-size: 20px;">play_circle</span>
                            Ver Clase
                        </a>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary w-100 rounded-3 fw-bold d-flex align-items-center justify-content-center gap-2">
                            <span class="material-symbols-outlined" style="font-size: 20px;">lock</span>
                            Inicia sesión para ver
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 py-5 text-center">
            <div class="text-muted-color mb-3">
                <span class="material-symbols-outlined" style="font-size: 64px;">fitness_center</span>
            </div>
            <h3 class="h5 fw-bold">No hay clases disponibles aún</h3>
            <p class="text-muted-color">Vuelve pronto para ver nuevo contenido.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection