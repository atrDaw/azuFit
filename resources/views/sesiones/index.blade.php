@extends('layout')

@section('title', 'Calendario de Clases - Azufit')

@section('content')
<div class="container py-5" style="min-height: 100vh;">

    {{-- Encabezado --}}
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold mb-3">Calendario en Directo</h1>
        <p class="lead text-muted-color mx-auto" style="max-width: 700px;">
            Reserva tu plaza y entrena con nosotros en tiempo real.
        </p>
        @if(auth()->user()->isAdmin)
        <div class="mt-4">
            <a href="{{ route('sesiones.create') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold d-inline-flex align-items-center gap-2 shadow-sm hover-scale">
                <span class="material-symbols-outlined">add_circle</span>
                Programar Sesión
            </a>
        </div>
        @endif
    </div>

    {{-- Lista de Sesiones (Estilo Agenda) --}}
    <div class="row justify-content-center">
        <div class="col-lg-9">

            @forelse($sesionesPorDia as $dia => $sesiones)
            {{-- Cabecera del Día --}}
            <div class="d-flex align-items-center gap-3 mb-3 mt-4">
                <span class="badge bg-primary rounded-pill px-3 py-2 text-uppercase fw-bold shadow-sm">
                    {{ $dia }}
                </span>
                <div class="flex-grow-1 border-bottom"></div>
            </div>

            {{-- Tarjetas de las sesiones de ese día --}}
            <div class="d-grid gap-3">
                @foreach($sesiones as $sesion)
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden hover-scale transition-all">
                    <div class="card-body p-0 d-flex flex-column flex-md-row">

                        {{-- Columna Hora --}}
                        <div class="bg-light p-3 d-flex flex-column justify-content-center align-items-center text-center" style="min-width: 120px;">
                            <span class="h4 fw-bold mb-0 text-dark">
                                {{ \Carbon\Carbon::parse($sesion->fecha_hora)->format('H:i') }}
                            </span>
                            <span class="small text-muted text-uppercase">Horas</span>
                        </div>

                        {{-- Columna Info --}}
                        <div class="p-3 flex-grow-1 d-flex flex-column justify-content-center border-start border-light">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="badge bg-opacity-50 bg-primary rounded-pill small">
                                    {{ $sesion->disciplina->nombre }}
                                </span>
                            </div>
                            <h5 class="fw-bold mb-0 text-dark">{{ $sesion->titulo }}</h5>
                        </div>

                        {{-- Columna Acción --}}
                        <div class="p-3 d-flex flex-column align-items-md-end justify-content-center bg-white border-start border-light gap-2" style="min-width: 200px;">

                            {{-- TRUCO: Usamos @forelse sobre la colección ya filtrada por el controlador --}}
                            {{-- Como solo traemos TU reserva, este bucle se ejecuta máximo 1 vez --}}
                            @forelse($sesion->reservas as $miReserva)

                            {{-- CASO A: SI ENTRA AQUÍ, ES QUE TIENES RESERVA --}}
                            @if($miReserva->estado === 'confirmada')
                            {{-- 1. CONFIRMADA --}}
                            <div class="d-flex align-items-center text-success mb-1 small">
                                <span class="material-symbols-outlined me-1" style="font-size: 18px;">check_circle</span>
                                <span class="fw-bold">Confirmada</span>
                            </div>
                            <a href="http://www.google.com"
                                class="btn btn-success text-white w-100 rounded-3 fw-bold px-3 btn-sm d-flex align-items-center justify-content-center gap-2 shadow-sm hover-scale">
                                <span class="material-symbols-outlined" style="font-size: 20px;">videocam</span>
                                Entrar
                            </a>

                            @elseif($miReserva->estado === 'pendiente')
                            {{-- 2. PENDIENTE --}}
                            <div class="d-flex align-items-center text-warning mb-1 small">
                                <span class="material-symbols-outlined me-1" style="font-size: 18px;">hourglass_top</span>
                                <span class="fw-bold">Pendiente</span>
                            </div>
                            <button disabled class="btn btn-light text-muted w-100 rounded-3 fw-bold px-3 btn-sm d-flex align-items-center justify-content-center gap-2 border">
                                <span class="material-symbols-outlined" style="font-size: 20px;">lock_clock</span>
                                Espera acceso
                            </button>

                            @elseif($miReserva->estado === 'cancelada')
                            {{-- 3. CANCELADA --}}
                            <div class="d-flex align-items-center text-danger mb-1 small">
                                <span class="material-symbols-outlined me-1" style="font-size: 18px;">cancel</span>
                                <span class="fw-bold">Cancelada</span>
                            </div>
                            <form action="{{ route('reservas.store') }}" method="POST" class="w-100">
                                @csrf
                                <input type="hidden" name="sesion_id" value="{{ $sesion->id }}">
                                <button type="submit" class="btn btn-outline-danger w-100 rounded-3 fw-bold px-3 btn-sm transition-all hover-scale d-flex align-items-center justify-content-center gap-2">
                                    <span class="material-symbols-outlined" style="font-size: 20px;">refresh</span>
                                    Reintentar
                                </button>
                            </form>
                            @endif

                            @empty
                            {{-- CASO B: SI ENTRA AQUÍ (EMPTY), NO TIENES RESERVA --}}
                            <form action="{{ route('reservas.store') }}" method="POST" class="w-100">
                                @csrf
                                <input type="hidden" name="sesion_id" value="{{ $sesion->id }}">

                                <button type="submit" class="btn btn-outline-primary w-100 rounded-3 fw-bold px-3 btn-sm transition-all hover-scale d-flex align-items-center justify-content-center gap-2">
                                    <span class="material-symbols-outlined" style="font-size: 20px;">calendar_add_on</span>
                                    Solicitar Plaza
                                </button>
                            </form>
                            @endforelse


                        </div>

                    </div>
                </div>
                @endforeach
            </div>
            @empty
            <div class="text-center py-5">
                <div class="mb-3 text-muted opacity-50">
                    <span class="material-symbols-outlined" style="font-size: 64px;">event_busy</span>
                </div>
                <h3 class="h5 fw-bold">No hay sesiones programadas</h3>
                <p class="text-muted">Vuelve más tarde para ver los próximos directos.</p>
            </div>
            @endforelse

        </div>
    </div>
</div>

@endsection