@extends('layout')

@section('title','Azufit')

@section('content')

<div class="container">
    <div class="row">
        <div class="display-4 mb-4 text-center">
            Registro
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form class="needs-validation p-2 border rounded" novalidate style="background-color: white;" action="{{route('signup')}}" method="post">
                @csrf
                <div class="form-row ">
                    <div class=" mb-3">
                        <label for="validationCustom01">Nombre</label>
                        <input type="text" name="name" class="form-control" id="validationCustom01" placeholder="Rick" value="" required>
                        <div class="invalid-feedback">
                          ?
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class=" mb-3">
                        <label for="validationCustom02">Apellido</label>
                        <input type="text" name="surname" class="form-control" id="validationCustom02" placeholder="Sanchez" value="" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    
                </div>
                <div class="form-row ">
                    <div class=" mb-3">
                        <label for="validationCustom03">Correo</label>
                        <input type="text" name="email" class="form-control" id="validationCustom03" placeholder="Correo" required>
                        <div class="invalid-feedback">
                            Please provide a valid mail.
                        </div>
                    </div>
                    <div class=" mb-3">
                        <label for="validationCustom04">Contraseña</label>
                        <input type="password" name="password" class="form-control" id="validationCustom04" placeholder="Contraseña" required>
                         <div class="invalid-feedback">
                            Introduce contraseña valida.
                        </div>
                        
                    </div>
                    <div class=" mb-3">
                        <label for="validationCustom05">Repetir contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control" id="validationCustom05" placeholder="Repetir contraseña" required>
                        <div class="invalid-feedback">
                            Introduce contraseña valida.
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center mb-3">

                    <button class="btn btn-primary w-50 " type="submit">Enviar</button>
                </div>
            </form>
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