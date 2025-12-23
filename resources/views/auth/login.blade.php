@extends('layout')

@section('title','Azufit')

@section('content')

<div class="container">
    <div class="row">
        <div class="display-4 mb-4 text-center">
            inicio de sesion
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            @error('login_error')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            <form action="{{route('login')}}" method="post" class="needs-validation p-2 border rounded" novalidate style="background-color: white;">
                @csrf

                <div class="form-row ">
                    <div class=" mb-3">
                        <label for="validationCustom03">Correo</label>
                        <input type="text" name='email' class="form-control" id="validationCustom03" placeholder="Correo" value="{{old('email')}}" required>
                        <div class="invalid-feedback">
                            Por favor introduce un mail valido.
                        </div>
                        @error('email')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class=" mb-3">
                        <label for="validationCustom04">Contraseña</label>
                        <input type="password" name='password' class="form-control" id="validationCustom04" placeholder="Contraseña" required>
                        <div class="invalid-feedback">
                            Por favor introduce una contraseña valida.
                        </div>
                    </div>

                    <div class="d-flex justify-content-center align-items-center mb-3">

                        <button class="btn btn-primary mr-3" type="submit">Enviar</button>
                        <div class="form-check ms-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="invalidCheck">
                            <label class="form-check-label" for="invalidCheck">
                                Recordar
                            </label>

                        </div>


                    </div>
            </form>
            <div class="row ">
                <div class=" text-center">
                    <a href="{{route('signup')}}">Regístrate</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
@endsection