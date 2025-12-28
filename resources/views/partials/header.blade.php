<nav class="navbar navbar-expand-md sticky-top shadow-sm px-4 py-3">
  <div class="container-fluid">

    <a class="navbar-brand d-flex align-items-center gap-2" href="{{route('home')}}">
      <div class="d-flex align-items-center text-primary-color" style="width: 24px; height: 24px;">
        <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
          <path d="M6 6H42L36 24L42 42H6L12 24L6 6Z" fill="currentColor"></path>
        </svg>
      </div>
      <h2 class="h5 mb-0 fw-bold">Azufit</h2>
    </a>

    <button aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-bs-target="#navbarNav" data-bs-toggle="collapse" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-4 gap-md-2 text-center">
        <li class="nav-item">
          <a class="nav-link fw-medium" href="{{route('clases.index')}}">Clases Online</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-medium" href="#">Clases Privadas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-medium" href="#">Sobre Nosotros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-medium" href="#">Testimonios</a>
        </li>
      </ul>

      <div class="d-flex justify-content-center align-items-center mt-3 mt-md-0">
        <a href="{{route('login')}}" class="btn btn-primary rounded-3 px-4 py-2 fw-bold">
          @auth
          {{Auth::user()->email}}
          @else
          Inicia Sesión
          @endauth
        </a>
        @auth
        <form method="POST" action="{{ route('logout') }}" class="ms-3">
          @csrf
          <button type="submit" class="btn btn-outline-secondary rounded-3  py-2 d-flex alin-items-center justify-content-center">
            <span class="material-symbols-outlined">
              logout
            </span>
          </button>
        </form>
        @endauth
      </div>
    </div>
  </div>
</nav>