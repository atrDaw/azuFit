@extends('layout')

@section('title', __('Gestión de Reservas - Azufit'))

@section('content')
<div class="container py-5">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">{{ __('Solicitudes de Reserva') }}</h1>
            <p class="text-muted small mb-0">{{ __('Gestiona las citas y solicitudes de tus alumnos.') }}</p>
        </div>

        <div class="d-flex gap-2 ">
            
            <a href="{{ route('sesiones.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-bold d-inline-flex align-items-center justify-content-center gap-2 shadow-sm hover-scale flex-grow-1 flex-md-grow-0">
                <span class="material-symbols-outlined">calendar_month</span>
                {{ __('Ver Calendario') }}
            </a>
        </div>
    </div>
    <div class="row justify-content-center mb-4">
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-3 bg-white">
                <div class="card-body p-3">
                    <form action="{{ route('admin.reservas.index') }}" method="GET" class="d-flex gap-2">

                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <span class="material-symbols-outlined" style="font-size: 20px;">filter_list</span>
                            </span>
                            <select name="estado" class="form-select border-start-0 bg-light" onchange="this.form.submit()">
                                <option value="">{{ __('Todos los Estados') }}</option>
                                <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>{{ __('Pendientes') }}</option>
                                <option value="confirmada" {{ request('estado') == 'confirmada' ? 'selected' : '' }}>{{ __('Confirmadas') }}</option>
                                <option value="cancelada" {{ request('estado') == 'cancelada' ? 'selected' : '' }}>{{ __('Canceladas') }}</option>
                            </select>
                        </div>

                        @if(request('estado'))
                        <a href="{{ route('admin.reservas.index') }}" class="btn btn-outline-secondary px-3 d-flex align-items-center" title="{{ __('Limpiar filtro') }}">
                            <span class="material-symbols-outlined">close</span>
                        </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3 overflow-hidden d-none d-md-block">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 small text-uppercase text-muted fw-bold">{{ __('Alumno') }}</th>
                            <th class="py-3 small text-uppercase text-muted fw-bold">{{ __('Sesión') }}</th>
                            <th class="py-3 small text-uppercase text-muted fw-bold">{{ __('Fecha') }}</th>
                            <th class="py-3 small text-uppercase text-muted fw-bold">{{ __('Estado') }}</th>
                            <th class="pe-4 py-3 small text-uppercase text-muted fw-bold text-end">{{ __('Acciones') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservas as $reserva)
                        <tr>
                            
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="lh-1">
                                        <div class="fw-bold text-dark">{{ $reserva->user->name }} {{ $reserva->user->surname }}</div>
                                        <small class="text-muted">{{ $reserva->user->email }}</small>
                                    </div>
                                </div>
                            </td>


                            <td>
                                <span class="badge bg-light text-dark border me-1">
                                    {{ $reserva->sesion->disciplina->nombre }}
                                </span>
                                <span class="small fw-bold">{{ $reserva->sesion->titulo }}</span>
                            </td>


                            <td>
                                <div class="d-flex flex-column">
                                    <span class="fw-bold text-dark">
                                        {{ $reserva->sesion->fecha_hora->format('d/m/Y') }}
                                    </span>
                                    <span class="small text-muted">
                                        {{ $reserva->sesion->fecha_hora->format('H:i') }} h
                                    </span>
                                </div>
                            </td>

                            <td>
                                @if($reserva->estado === 'pendiente')
                                <span class="badge bg-warning text-dark rounded-pill px-3">{{ __('Pendiente') }}</span>
                                @elseif($reserva->estado === 'confirmada')
                                <span class="badge bg-success rounded-pill px-3">{{ __('Confirmada') }}</span>
                                @else
                                <span class="badge bg-danger rounded-pill px-3">{{ __('Cancelada') }}</span>
                                @endif
                            </td>


                            <td class="pe-4 text-end">
                                @if($reserva->estado === 'pendiente')
                                <div class="d-flex justify-content-end gap-2">
                                    <form action="{{ route('reservas.update', $reserva->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="estado" value="confirmada">
                                        <button type="submit" class="btn btn-success btn-sm rounded-circle shadow-sm hover-scale" title="{{ __('Aceptar reserva') }}">
                                            <span class="material-symbols-outlined" style="font-size: 18px;">check</span>
                                        </button>
                                    </form>

                                    <form action="{{ route('reservas.update', $reserva->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="estado" value="cancelada">
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle hover-scale" title="{{ __('Rechazar reserva') }}">
                                            <span class="material-symbols-outlined" style="font-size: 18px;">close</span>
                                        </button>
                                    </form>
                                </div>
                                @elseif($reserva->estado === 'confirmada')

                                <form action="{{ route('reservas.update', $reserva->id) }}" method="POST" class="d-inline form-cancelar">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="estado" value="cancelada">
                                    <button type="submit" class="btn btn-link text-danger p-0 small text-decoration-none" title="{{ __('Cancelar') }}">
                                        {{ __('Cancelar') }}
                                    </button>
                                </form>
                                @else
                                <span class="text-muted small fst-italic">{{ __('Finalizada') }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <span class="material-symbols-outlined d-block mb-2" style="font-size: 32px; opacity: 0.5;">inbox</span>
                                {{ __('No tienes solicitudes pendientes.') }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white border-top border-light py-3">
                {{ $reservas->links() }}
            </div>
        </div>
    </div>
    <div class="d-md-none">
        @forelse($reservas as $reserva)
        <div class="card border-0 shadow-sm rounded-3 mb-3">
            <div class="card-body p-3">


                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="lh-1">
                            <div class="fw-bold text-dark">{{ $reserva->user->name }}</div>
                            <small class="text-muted" style="font-size: 0.75rem;">{{ $reserva->user->surname }}</small>
                        </div>
                    </div>

                    <div>
                        @if($reserva->estado === 'pendiente')
                        <span class="badge bg-warning text-dark rounded-pill">{{ __('Pendiente') }}</span>
                        @elseif($reserva->estado === 'confirmada')
                        <span class="badge bg-success rounded-pill">{{ __('Confirmada') }}</span>
                        @else
                        <span class="badge bg-danger rounded-pill">{{ __('Cancelada') }}</span>
                        @endif
                    </div>
                </div>


                <div class="bg-light rounded-3 p-3 mb-3">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="material-symbols-outlined text-muted" style="font-size: 18px;">fitness_center</span>
                        <span class="fw-bold text-dark">{{ $reserva->sesion->disciplina->nombre }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="material-symbols-outlined text-muted" style="font-size: 18px;">event</span>

                        <span>{{ $reserva->sesion->fecha_hora->format('d/m/Y') }}</span>
                        <span class="text-muted">|</span>
                        <span>{{ $reserva->sesion->fecha_hora->format('H:i') }} h</span>
                    </div>
                    <div class="text-muted small ps-4 mt-1">
                        {{ $reserva->sesion->titulo }}
                    </div>
                </div>


                <div class="d-flex gap-2">
                    @if($reserva->estado === 'pendiente')
                    <form action="{{ route('reservas.update', $reserva->id) }}" method="POST" class="flex-grow-1">
                        @csrf @method('PUT')
                        <input type="hidden" name="estado" value="confirmada">
                        <button type="submit" class="btn btn-success btn-sm w-100 py-2 d-flex align-items-center justify-content-center gap-1 fw-bold">
                            <span class="material-symbols-outlined" style="font-size: 18px;">check</span> {{ __('Aceptar') }}
                        </button>
                    </form>

                    <form action="{{ route('reservas.update', $reserva->id) }}" method="POST" class="flex-grow-1">
                        @csrf @method('PUT')
                        <input type="hidden" name="estado" value="cancelada">
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100 py-2 d-flex align-items-center justify-content-center gap-1 fw-bold">
                            <span class="material-symbols-outlined" style="font-size: 18px;">close</span> {{ __('Rechazar') }}
                        </button>
                    </form>
                    @elseif($reserva->estado === 'confirmada')

                    <form action="{{ route('reservas.update', $reserva->id) }}" method="POST" class="w-100 form-cancelar">
                        @csrf @method('PUT')
                        <input type="hidden" name="estado" value="cancelada">
                        <button type="submit" class="btn btn-outline-secondary btn-sm w-100 py-2 fw-bold">
                            {{ __('Cancelar Reserva') }}
                        </button>
                    </form>
                    @else
                    <button disabled class="btn btn-light text-muted w-100 btn-sm">{{ __('Finalizada') }}</button>
                    @endif
                </div>

            </div>
        </div>
        @empty
        <div class="text-center py-5 text-muted">
            <span class="material-symbols-outlined d-block mb-2" style="font-size: 48px; opacity: 0.3;">inbox</span>
            <p>{{ __('No tienes solicitudes pendientes.') }}</p>
        </div>
        @endforelse

        <div class="mt-3">
            {{ $reservas->links() }}
        </div>
    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        const forms = document.querySelectorAll('.form-cancelar');

        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "{{ __('¿Estás seguro?') }}",
                    text: "{{ __('Estás a punto de cancelar una reserva que ya estaba confirmada.') }}",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#d33', 
                    cancelButtonColor: '#6c757d', 
                    confirmButtonText: "{{ __('Sí, cancelar reserva') }}",
                    cancelButtonText: "{{ __('No, volver') }}"
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