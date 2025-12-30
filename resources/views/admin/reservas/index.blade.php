@extends('layout')

@section('title', 'Gestión de Reservas - Azufit')

@section('content')
<div class="container py-5">

    {{-- Cabecera --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Solicitudes de Reserva</h1>
            <p class="text-muted small mb-0">Gestiona las citas y solicitudes de tus alumnos.</p>
        </div>

        <div class="d-flex gap-2 ">
            {{-- Enlace para volver al calendario --}}
            <a href="{{ route('sesiones.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-bold d-inline-flex align-items-center justify-content-center gap-2 shadow-sm hover-scale flex-grow-1 flex-md-grow-0">
                <span class="material-symbols-outlined">calendar_month</span>
                Ver Calendario
            </a>
        </div>
    </div>

    {{-- ================================================================== --}}
    {{-- VISTA DE ESCRITORIO (Visible en pantallas medianas y grandes)      --}}
    {{-- ================================================================== --}}
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden d-none d-md-block">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 small text-uppercase text-muted fw-bold">Alumno</th>
                            <th class="py-3 small text-uppercase text-muted fw-bold">Sesión</th>
                            <th class="py-3 small text-uppercase text-muted fw-bold">Fecha</th>
                            <th class="py-3 small text-uppercase text-muted fw-bold">Estado</th>
                            <th class="pe-4 py-3 small text-uppercase text-muted fw-bold text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservas as $reserva)
                        <tr>
                            {{-- ALUMNO --}}
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="lh-1">
                                        <div class="fw-bold text-dark">{{ $reserva->user->name }} {{ $reserva->user->surname }}</div>
                                        <small class="text-muted">{{ $reserva->user->email }}</small>
                                    </div>
                                </div>
                            </td>

                            {{-- SESIÓN --}}
                            <td>
                                <span class="badge bg-light text-dark border me-1">
                                    {{ $reserva->sesion->disciplina->nombre }}
                                </span>
                                <span class="small fw-bold">{{ $reserva->sesion->titulo }}</span>
                            </td>

                            {{-- FECHA (OPTIMIZADO: Uso directo del objeto Carbon) --}}
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

                            {{-- ESTADO --}}
                            <td>
                                @if($reserva->estado === 'pendiente')
                                <span class="badge bg-warning text-dark rounded-pill px-3">Pendiente</span>
                                @elseif($reserva->estado === 'confirmada')
                                <span class="badge bg-success rounded-pill px-3">Confirmada</span>
                                @else
                                <span class="badge bg-danger rounded-pill px-3">Cancelada</span>
                                @endif
                            </td>

                            {{-- ACCIONES --}}
                            <td class="pe-4 text-end">
                                @if($reserva->estado === 'pendiente')
                                <div class="d-flex justify-content-end gap-2">
                                    <form action="{{ route('reservas.update', $reserva->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="estado" value="confirmada">
                                        <button type="submit" class="btn btn-success btn-sm rounded-circle shadow-sm hover-scale" title="Aceptar reserva">
                                            <span class="material-symbols-outlined" style="font-size: 18px;">check</span>
                                        </button>
                                    </form>

                                    <form action="{{ route('reservas.update', $reserva->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="estado" value="cancelada">
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle hover-scale" title="Rechazar reserva">
                                            <span class="material-symbols-outlined" style="font-size: 18px;">close</span>
                                        </button>
                                    </form>
                                </div>
                                @elseif($reserva->estado === 'confirmada')
                                {{-- Formulario cancelar con clase 'form-cancelar' para SweetAlert --}}
                                <form action="{{ route('reservas.update', $reserva->id) }}" method="POST" class="d-inline form-cancelar">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="estado" value="cancelada">
                                    <button type="submit" class="btn btn-link text-danger p-0 small text-decoration-none" title="Cancelar">
                                        Cancelar
                                    </button>
                                </form>
                                @else
                                <span class="text-muted small fst-italic">Finalizada</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <span class="material-symbols-outlined d-block mb-2" style="font-size: 32px; opacity: 0.5;">inbox</span>
                                No tienes solicitudes pendientes.
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

    {{-- ================================================================== --}}
    {{-- VISTA MÓVIL (Visible solo en pantallas pequeñas)                   --}}
    {{-- ================================================================== --}}
    <div class="d-md-none">
        @forelse($reservas as $reserva)
        <div class="card border-0 shadow-sm rounded-3 mb-3">
            <div class="card-body p-3">

                {{-- Cabecera Tarjeta: Usuario y Estado --}}
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="lh-1">
                            <div class="fw-bold text-dark">{{ $reserva->user->name }}</div>
                            <small class="text-muted" style="font-size: 0.75rem;">{{ $reserva->user->surname }}</small>
                        </div>
                    </div>

                    <div>
                        @if($reserva->estado === 'pendiente')
                        <span class="badge bg-warning text-dark rounded-pill">Pendiente</span>
                        @elseif($reserva->estado === 'confirmada')
                        <span class="badge bg-success rounded-pill">Confirmada</span>
                        @else
                        <span class="badge bg-danger rounded-pill">Cancelada</span>
                        @endif
                    </div>
                </div>

                {{-- Cuerpo Tarjeta: Detalles de la Sesión (OPTIMIZADO) --}}
                <div class="bg-light rounded-3 p-3 mb-3">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="material-symbols-outlined text-muted" style="font-size: 18px;">fitness_center</span>
                        <span class="fw-bold text-dark">{{ $reserva->sesion->disciplina->nombre }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="material-symbols-outlined text-muted" style="font-size: 18px;">event</span>
                        {{-- Uso directo de objeto Carbon --}}
                        <span>{{ $reserva->sesion->fecha_hora->format('d/m/Y') }}</span>
                        <span class="text-muted">|</span>
                        <span>{{ $reserva->sesion->fecha_hora->format('H:i') }} h</span>
                    </div>
                    <div class="text-muted small ps-4 mt-1">
                        {{ $reserva->sesion->titulo }}
                    </div>
                </div>

                {{-- Pie Tarjeta: Acciones (Botones Grandes) --}}
                <div class="d-flex gap-2">
                    @if($reserva->estado === 'pendiente')
                    <form action="{{ route('reservas.update', $reserva->id) }}" method="POST" class="flex-grow-1">
                        @csrf @method('PUT')
                        <input type="hidden" name="estado" value="confirmada">
                        <button type="submit" class="btn btn-success btn-sm w-100 py-2 d-flex align-items-center justify-content-center gap-1 fw-bold">
                            <span class="material-symbols-outlined" style="font-size: 18px;">check</span> Aceptar
                        </button>
                    </form>

                    <form action="{{ route('reservas.update', $reserva->id) }}" method="POST" class="flex-grow-1">
                        @csrf @method('PUT')
                        <input type="hidden" name="estado" value="cancelada">
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100 py-2 d-flex align-items-center justify-content-center gap-1 fw-bold">
                            <span class="material-symbols-outlined" style="font-size: 18px;">close</span> Rechazar
                        </button>
                    </form>
                    @elseif($reserva->estado === 'confirmada')
                    {{-- Formulario cancelar con clase 'form-cancelar' --}}
                    <form action="{{ route('reservas.update', $reserva->id) }}" method="POST" class="w-100 form-cancelar">
                        @csrf @method('PUT')
                        <input type="hidden" name="estado" value="cancelada">
                        <button type="submit" class="btn btn-outline-secondary btn-sm w-100 py-2 fw-bold">
                            Cancelar Reserva
                        </button>
                    </form>
                    @else
                    <button disabled class="btn btn-light text-muted w-100 btn-sm">Finalizada</button>
                    @endif
                </div>

            </div>
        </div>
        @empty
        <div class="text-center py-5 text-muted">
            <span class="material-symbols-outlined d-block mb-2" style="font-size: 48px; opacity: 0.3;">inbox</span>
            <p>No tienes solicitudes pendientes.</p>
        </div>
        @endforelse

        <div class="mt-3">
            {{ $reservas->links() }}
        </div>
    </div>

</div>

{{-- SCRIPT SWEETALERT2 --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Seleccionamos todos los formularios marcados con la clase 'form-cancelar'
        const forms = document.querySelectorAll('.form-cancelar');

        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                // Detenemos el envío automático
                e.preventDefault();

                // Mostramos la alerta bonita
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Estás a punto de cancelar una reserva que ya estaba confirmada.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33', // Rojo
                    cancelButtonColor: '#6c757d', // Gris
                    confirmButtonText: 'Sí, cancelar reserva',
                    cancelButtonText: 'No, volver'
                }).then((result) => {
                    // Si el usuario confirma, enviamos el formulario manualmente
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    });
</script>
@endsection