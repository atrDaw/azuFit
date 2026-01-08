@extends('layout')

@section('title', __('Calendario de Clases - Azufit'))

@section('content')
<div class="container py-5" style="min-height: 100vh;">

    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold mb-3">{{ __('Calendario en Directo') }}</h1>
        <p class="lead text-muted-color mx-auto" style="max-width: 700px;">
            {{ __('Reserva tu plaza y entrena con nosotros en tiempo real.') }}
        </p>

        @auth
        @if(auth()->user()->isAdmin)
        <div class="mt-4 d-flex justify-content-center gap-3">
            <a href="{{ route('sesiones.create') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold d-inline-flex align-items-center gap-2 shadow-sm hover-scale">
                <span class="material-symbols-outlined">add_circle</span>
                {{ __('Programar Sesión') }}
            </a>
            <a href="{{ route('admin.reservas.index') }}" class="btn btn-dark rounded-pill px-4 py-2 fw-bold d-inline-flex align-items-center gap-2 shadow-sm hover-scale">
                <span class="material-symbols-outlined">inbox</span>
                {{ __('Gestionar Solicitudes') }}
            </a>
        </div>
        @endif
        @endauth
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm rounded-3 bg-white">
                <div class="card-body p-3">
                    <form action="{{ route('sesiones.index') }}" method="GET" class="d-flex gap-2">

                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted"><span class="material-symbols-outlined" style="font-size: 20px;">fitness_center</span></span>
                            <select name="disciplina_id" class="form-select border-start-0 bg-light" onchange="this.form.submit()">
                                <option value="">{{ __('Todas las Disciplinas') }}</option>
                                @foreach($disciplinas as $disciplina)
                                <option value="{{ $disciplina->id }}" {{ request('disciplina_id') == $disciplina->id ? 'selected' : '' }}>
                                    {{ $disciplina->nombre }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        @if(request('disciplina_id'))
                        <a href="{{ route('sesiones.index') }}" class="btn btn-outline-secondary px-3" title="{{ __('Limpiar filtro') }}">
                            <span class="material-symbols-outlined" style="vertical-align: middle;">close</span>
                        </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-9">

            @forelse($sesionesPorDia as $dia => $sesiones)
            <div class="d-flex align-items-center gap-3 mb-3 mt-4">
                <span class="badge bg-primary rounded-pill px-3 py-2 text-uppercase fw-bold shadow-sm">
                    {{ $dia }}
                </span>
                <div class="flex-grow-1 border-bottom"></div>
            </div>

            <div class="d-grid gap-3">
                @foreach($sesiones as $sesion)
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden hover-scale transition-all">
                    <div class="card-body p-0 d-flex flex-column flex-md-row">

                        <div class="bg-light p-3 d-flex flex-column justify-content-center align-items-center text-center" style="min-width: 120px;">
                            <span class="h4 fw-bold mb-0 text-dark">
                                {{ $sesion->fecha_hora->format('H:i') }}
                            </span>

                        </div>

                        <div class="p-3 flex-grow-1 d-flex flex-column justify-content-center border-start border-light">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="badge bg-opacity-50 bg-primary rounded-pill small">
                                    {{ $sesion->disciplina->nombre }}
                                </span>
                                @if($sesion->esta_ocupada && auth()->check() && auth()->user()->isAdmin)
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger">{{ __('Ocupada') }}</span>
                                @endif
                            </div>
                            <h5 class="fw-bold mb-0 text-dark">{{ $sesion->titulo }}</h5>
                        </div>

                        <div class="p-3 d-flex flex-column align-items-md-end justify-content-center bg-white border-start border-light gap-2" style="min-width: 200px;">

                            @auth
                            @if(auth()->user()->isAdmin)

                            <div class="d-flex gap-2 w-100 justify-content-end">
                                <a href="{{ route('sesiones.edit', $sesion->id) }}" class="btn btn-outline-secondary btn-sm rounded-3 d-flex align-items-center gap-1" title="{{ __('Editar Sesión') }}">
                                    <span class="material-symbols-outlined" style="font-size: 18px;">edit</span>
                                    {{ __('Editar') }}
                                </a>

                                <form action="{{ route('sesiones.destroy', $sesion->id) }}" method="POST" class="form-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-3 d-flex align-items-center gap-1 " title="{{ __('Eliminar Sesión') }}">
                                        <span class="material-symbols-outlined" style="font-size: 18px;">delete</span>
                                        {{ __('Borrar') }}
                                    </button>
                                </form>
                            </div>

                            @else

                            @forelse($sesion->reservas as $miReserva)
                            @if($miReserva->estado === 'confirmada')
                            <div class="d-flex align-items-center text-success mb-1 small">
                                <span class="material-symbols-outlined me-1" style="font-size: 18px;">check_circle</span>
                                <span class="fw-bold">{{ __('Confirmada') }}</span>
                            </div>
                            <a href="{{$miReserva->sesion->url_sesion}}" target="_blank"
                                class="btn btn-success text-white w-100 rounded-3 fw-bold px-3 btn-sm d-flex align-items-center justify-content-center gap-2 shadow-sm hover-scale">
                                <span class="material-symbols-outlined" style="font-size: 20px;">videocam</span>
                                {{ __('Entrar') }}
                            </a>

                            @elseif($miReserva->estado === 'pendiente')
                            <div class="d-flex align-items-center text-warning mb-1 small">
                                <span class="material-symbols-outlined me-1" style="font-size: 18px;">hourglass_top</span>
                                <span class="fw-bold">{{ __('Pendiente') }}</span>
                            </div>
                            <button disabled class="btn btn-light text-muted w-100 rounded-3 fw-bold px-3 btn-sm d-flex align-items-center justify-content-center gap-2 border">
                                <span class="material-symbols-outlined" style="font-size: 20px;">lock_clock</span>
                                {{ __('Espera acceso') }}
                            </button>

                            @elseif($miReserva->estado === 'cancelada')
                            <div class="d-flex align-items-center text-danger mb-1 small">
                                <span class="material-symbols-outlined me-1" style="font-size: 18px;">cancel</span>
                                <span class="fw-bold">{{ __('Cancelada') }}</span>
                            </div>
                            <form action="{{ route('reservas.store') }}" method="POST" class="w-100">
                                @csrf
                                <input type="hidden" name="sesion_id" value="{{ $sesion->id }}">
                                <button type="submit" class="btn btn-outline-danger w-100 rounded-3 fw-bold px-3 btn-sm transition-all hover-scale d-flex align-items-center justify-content-center gap-2">
                                    <span class="material-symbols-outlined" style="font-size: 20px;">refresh</span>
                                    {{ __('Reintentar') }}
                                </button>
                            </form>
                            @endif

                            @empty
                            @if($sesion->esta_ocupada)
                            <button disabled class="btn btn-secondary w-100 rounded-3 fw-bold px-3 btn-sm d-flex align-items-center justify-content-center gap-2 opacity-50" title="{{ __('Sesión reservada por otro usuario') }}">
                                <span class="material-symbols-outlined" style="font-size: 20px;">block</span>
                                {{ __('Ocupada') }}
                            </button>
                            @else
                            <form action="{{ route('reservas.store') }}" method="POST" class="w-100">
                                @csrf
                                <input type="hidden" name="sesion_id" value="{{ $sesion->id }}">
                                <button type="submit" class="btn btn-outline-primary w-100 rounded-3 fw-bold px-3 btn-sm transition-all hover-scale d-flex align-items-center justify-content-center gap-2">
                                    <span class="material-symbols-outlined" style="font-size: 20px;">calendar_add_on</span>
                                    {{ __('Solicitar Plaza') }}
                                </button>
                            </form>
                            @endif
                            @endforelse

                            @endif

                            @else
                            <a href="{{ route('login') }}" class="btn btn-light text-muted w-100 rounded-3 px-3 btn-sm d-flex align-items-center justify-content-center gap-2 border">
                                <span class="material-symbols-outlined" style="font-size: 18px;">login</span>
                                {{ __('Inicia sesión') }}
                            </a>
                            @endauth

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
                <h3 class="h5 fw-bold">{{ __('No hay sesiones programadas') }}</h3>
                <p class="text-muted">{{ __('Vuelve más tarde para ver los próximos directos.') }}</p>
            </div>
            @endforelse

        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('.form-eliminar');

        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: "{{ __('¿Estás seguro?') }}",
                    text: "{{ __('¡No podrás revertir esta acción!') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: "{{ __('Sí, eliminar') }}",
                    cancelButtonText: "{{ __('Cancelar') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    });
</script>

@endsection