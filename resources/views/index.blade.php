@extends('layout')
@section('title', __('Azufit - Tu Estudio de Pilates Online'))
@section('content')
<main class="flex-grow-1 d-flex flex-column align-items-center">

  <section class="w-100 mb-4 mt-5 px-3 px-md-0">
    <div class="container-fluid container-md p-0">
      <div class="jumbotron-bg d-flex flex-column align-items-center justify-content-center text-center text-white jumbotron-inner rounded-3">
        <div class="col-md-8 px-4">
          <h1 class="display-5 fw-bold mb-3">{{ __('Transforma tu Cuerpo y Mente con Azufit Pilates') }}</h1>
          <p class="lead mb-4">{{ __('Descubre el poder del pilates desde la comodidad de tu hogar. Únete a nuestra comunidad y comienza tu viaje hacia un yo más fuerte y equilibrado.') }}</p>
          <a class="btn btn-primary btn-lg rounded-3 py-2 px-4 fw-bold" href="#" role="button">{{ __('Comienza Tu Viaje') }}</a>
        </div>
      </div>
    </div>
  </section>

  <section class="w-100 py-5 pb-3">
    <div class="container-fluid container-md">
      <h2 class="h3 fw-bold text-center mb-4">{{ __('Nuestras Clases') }}</h2>
      <div class="row g-4 justify-content-center">

        <div class="col-md-6 col-lg-5">
          <div class="card h-100 border-0 card-hover-shadow shadow-sm">
            <div class="service-card-img rounded-3" style='background-image: url("{{asset("images/service-card-img-1.png")}}")'></div>
            <div class="card-body p-3">
              <h3 class="h5 fw-bold card-title mb-1">{{ __('Clases Grupales Online') }}</h3>
              <p class="card-text text-muted-color mb-2">{{ __('Experimenta la energía y la comunidad de nuestras clases en vivo en línea, aptas para todos los niveles.') }}</p>
              <a class="btn btn-link text-primary-color fw-bold text-decoration-none p-0" href="#">{{ __('Aprende Más') }}</a>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-5">
          <div class="card h-100 border-0 card-hover-shadow shadow-sm">
            <div class="service-card-img rounded-3" style='background-image: url("{{asset("images/service-card-img-2.png")}}");'></div>
            <div class="card-body p-3">
              <h3 class="h5 fw-bold card-title mb-1">{{ __('Sesiones Privadas') }}</h3>
              <p class="card-text text-muted-color mb-2">{{ __('Recibe atención personalizada y un programa adaptado a tus objetivos específicos con instrucción individual.') }}</p>
              <a class="btn btn-link text-primary-color fw-bold text-decoration-none p-0" href="#">{{ __('Aprende Más') }}</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="w-100 py-5 bg-white rounded-3">
    <div class="container-fluid container-md">
      <div class="text-center mb-5">
        <h2 class="h3 fw-bold mb-2">{{ __('¿Por qué Azufit?') }}</h2>
        <p class="lead text-muted-color mx-auto" style="max-width: 700px;">{{ __('Nos dedicamos a proporcionar una experiencia de pilates de apoyo y efectiva para todos.') }}</p>
      </div>

      <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
          <div class="d-flex flex-column align-items-center text-center h-100 card-feature feature-card-compact card-hover-shadow">
            <div class="text-primary-color mb-2">
              <span class="material-symbols-outlined" style="font-size: 48px;">workspace_premium</span>
            </div>
            <h3 class="h6 fw-bold mb-1">{{ __('Instructores Expertos') }}</h3>
            <p class="small text-muted-color mb-0">{{ __('Aprende de profesionales certificados apasionados por tu progreso.') }}</p>
          </div>
        </div>

        <div class="col">
          <div class="d-flex flex-column align-items-center text-center h-100 card-feature feature-card-compact card-hover-shadow">
            <div class="text-primary-color mb-2">
              <span class="material-symbols-outlined" style="font-size: 48px;">schedule</span>
            </div>
            <h3 class="h6 fw-bold mb-1">{{ __('Horario Flexible') }}</h3>
            <p class="small text-muted-color mb-0">{{ __('Encuentra clases que se ajusten a tu vida, con una variedad de horarios disponibles cada semana.') }}</p>
          </div>
        </div>

        <div class="col">
          <div class="d-flex flex-column align-items-center text-center h-100 card-feature feature-card-compact card-hover-shadow">
            <div class="text-primary-color mb-2">
              <span class="material-symbols-outlined" style="font-size: 48px;">groups</span>
            </div>
            <h3 class="h6 fw-bold mb-1">{{ __('Todos los Niveles') }}</h3>
            <p class="small text-muted-color mb-0">{{ __('Ya seas principiante o avanzado, tenemos la clase adecuada para ti.') }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="w-100">
    <div class="container-fluid container-md my-4">
      <div class="position-relative overflow-hidden rounded-3 bg-accent-color py-5 px-4 text-center">
        <h2 class="h3 fw-bolder mb-3 text-dark">{{ __('¿Lista para empezar?') }}</h2>
        <p class="lead mx-auto mb-4 text-dark" style="max-width: 600px;">{{ __('Únete a la comunidad de Azufit hoy y da el primer paso hacia una versión más saludable y feliz de ti mismo. Explora nuestro horario de clases y encuentra la perfecta para ti.') }}</p>
        <a class="btn btn-primary btn-lg rounded-3 py-2 px-4 fw-bold" href="{{ route('clases.index') }}" role="button">{{ __('Explorar Clases') }}</a>
      </div>
    </div>
  </section>

</main>
@endsection