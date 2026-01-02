@extends('layout')

@section('title', 'Catálogo de Clases - Azufit')

@section('content')
<div class="container-fluid container-md py-5" style="min-height: 80vh;">


    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold mb-3">Catálogo de Clases Grabadas</h1>
        <p class="lead text-muted-color mx-auto" style="max-width: 700px;">
            Explora nuestra biblioteca de vídeos y entrena a tu ritmo desde cualquier lugar.
        </p>
        @if(auth()->user() && auth()->user()->isAdmin)
        <div class="mt-4">
            <a href="{{ route('clases.create') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold d-inline-flex align-items-center gap-2 shadow-sm hover-scale">
                <span class="material-symbols-outlined">add_circle</span>
                Crear Nueva Clase
            </a>
        </div>
        @endif
    </div>
    {{-- BARRA DE FILTROS --}}
    <div class="row justify-content-center mb-5">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm rounded-3 bg-white">
                <div class="card-body p-3">
                    <form action="{{ route('clases.index') }}" method="GET" class="row g-2 align-items-center">

                        {{-- Filtro Disciplina --}}
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><span class="material-symbols-outlined" style="font-size: 20px;">fitness_center</span></span>
                                <select name="disciplina_id" class="form-select border-start-0 bg-light" onchange="this.form.submit()">
                                    <option value="">Todas las Disciplinas</option>
                                    @foreach($disciplinas as $disciplina)
                                    <option value="{{ $disciplina->id }}" {{ request('disciplina_id') == $disciplina->id ? 'selected' : '' }}>
                                        {{ $disciplina->nombre }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Filtro Nivel --}}
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><span class="material-symbols-outlined" style="font-size: 20px;">signal_cellular_alt</span></span>
                                <select name="nivel" class="form-select border-start-0 bg-light" onchange="this.form.submit()">
                                    <option value="">Todos los Niveles</option>
                                    <option value="Principiante" {{ request('nivel') == 'Principiante' ? 'selected' : '' }}>Principiante</option>
                                    <option value="Intermedio" {{ request('nivel') == 'Intermedio' ? 'selected' : '' }}>Intermedio</option>
                                    <option value="Avanzado" {{ request('nivel') == 'Avanzado' ? 'selected' : '' }}>Avanzado</option>
                                </select>
                            </div>
                        </div>

                        {{-- Botones Acción --}}
                        <div class="col-md-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100 fw-bold rounded-3">Filtrar</button>
                            @if(request('disciplina_id') || request('nivel'))
                            <a href="{{ route('clases.index') }}" class="btn btn-outline-secondary w-100 fw-bold rounded-3">Limpiar</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                        <a href="{{ route('clases.show', $clase->id) }}" class="btn w-100 rounded-3 fw-bold d-flex align-items-center justify-content-center gap-2 @auth btn-primary @else btn-outline-secondary @endauth">
                            @auth
                            <span class="material-symbols-outlined" style="font-size: 20px;">play_circle</span>
                            Ver Clase
                            @else
                            <span class="material-symbols-outlined" style="font-size: 20px;">lock</span>
                            Inicia sesión para ver
                            @endauth
                        </a>

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