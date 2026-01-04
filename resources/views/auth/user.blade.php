@extends('layout')

@section('title', __('Mi Perfil - Azufit'))

@section('content')
<div class="container py-5" style="min-height: 80vh;">

    <div class="mb-2">
        <a href="{{ route('home') }}" class="text-decoration-none text-muted small d-inline-flex align-items-center gap-1">
            <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
            {{ __('Volver al inicio') }}
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

            <div class="card border-0 shadow-sm rounded-3 bg-white overflow-hidden">

                <div class="bg-light border-bottom p-4 text-center">

                    <h1 class="h3 fw-bold mb-1">{{ $user->name }} {{ $user->surname }}</h1>
                    <p class="text-muted small mb-0">{{ $user->email }}</p>

                    <div class="mt-2">
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 text-capitalize">{{$user->role->nombre_rol}}</span>
                    </div>
                </div>

                <div class="card-body p-4">

                    <h2 class="h6 fw-bold text-muted-color text-uppercase small mb-3">{{ __('Datos Personales') }}</h2>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 border-0 h-100">
                                <label class="small text-muted mb-1 d-block">{{ __('Nombre') }}</label>
                                <span class="fw-medium text-dark">{{ $user->name }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 border-0 h-100">
                                <label class="small text-muted mb-1 d-block">{{ __('Apellido') }}</label>
                                <span class="fw-medium text-dark">{{ $user->surname }}</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-3 bg-light rounded-3 border-0">
                                <label class="small text-muted mb-1 d-block">{{ __('Correo Electrónico') }}</label>
                                <span class="fw-medium text-dark">{{ $user->email }}</span>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="p-3 bg-light rounded-3 border-0 d-flex align-items-center gap-3">
                                <div class="text-primary-color">
                                    <span class="material-symbols-outlined" style="font-size: 24px;">calendar_today</span>
                                </div>
                                <div>
                                    <label class="small text-muted mb-0 d-block">{{ __('Miembro desde') }}</label>
                                    <span class="fw-medium text-dark">{{ $user->created_at?->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection