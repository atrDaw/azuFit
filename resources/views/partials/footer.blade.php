<footer class="w-100 bg-dark text-white border-top py-5">
  <div class="container-fluid container-md">
    <div class="row g-4 justify-content-between">
      
      <div class="col-12 col-md-4 col-lg-3">
        <div class="d-flex align-items-center gap-2 mb-3">
          <div class="text-primary-color" style="width: 24px; height: 24px;">
            <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
              <path d="M6 6H42L36 24L42 42H6L12 24L6 6Z" fill="currentColor"></path>
            </svg>
          </div>
          <h2 class="h5 fw-bold mb-0">Azufit</h2>
        </div>
        <!-- Texto largo descriptivo -->
        <p class="small text-muted-color">{{ __('texto.footer') }}</p>
      </div>

      <div class="col-6 col-md-auto">
        <h3 class="fw-bold mb-3">{{ __('Explorar') }}</h3>
        <ul class="list-unstyled d-flex flex-column gap-2">
          <li><a class="small text-muted-color text-decoration-none" href="#">{{ __('Clases Online') }}</a></li>
          <li><a class="small text-muted-color text-decoration-none" href="#">{{ __('Clases Privadas') }}</a></li>
          <li><a class="small text-muted-color text-decoration-none" href="#">{{ __('Precios') }}</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-auto">
        <h3 class="fw-bold mb-3">{{ __('Compañía') }}</h3>
        <ul class="list-unstyled d-flex flex-column gap-2">
          <li><a class="small text-muted-color text-decoration-none" href="#">{{ __('Sobre Nosotros') }}</a></li>
          <li><a class="small text-muted-color text-decoration-none" href="#">{{ __('Contacto') }}</a></li>
          <li><a class="small text-muted-color text-decoration-none" href="#">{{ __('Carreras') }}</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-auto">
        <h3 class="fw-bold mb-3">{{ __('Legal') }}</h3>
        <ul class="list-unstyled d-flex flex-column gap-2">
          <li><a class="small text-muted-color text-decoration-none" href="#">{{ __('Términos de Servicio') }}</a></li>
          <li><a class="small text-muted-color text-decoration-none" href="#">{{ __('Política de Privacidad') }}</a></li>
        </ul>
      </div>
    </div>
    
    <hr class="my-4 text-muted-color" />
    
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center small text-muted-color">
      <!-- El año y el nombre de la marca no necesitan traducción, el resto sí -->
      <p class="mb-2 mb-sm-0">© {{date('Y')}} Azufit. {{ __('Todos los derechos reservados.') }}</p>
      <div>
      </div>
    </div>
  </div>
</footer>