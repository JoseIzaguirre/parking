<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Parking</title>
    <style>
      /* .modal{
      display: block !important; 
      }

      .modal-dialog{
          overflow-y: initial !important
      } */
      .modal-body2{
          height: 60vh;
          overflow-y: auto;
      }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ url('/') }}">Parking</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Vehiculos Oficiales
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#registerOfficial">Dar de alta</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('official.index') }}">Mostrar lista</a>
                {{-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#listOfficial">Mostrar lista</a> --}}
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Vehiculos Residentes
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#registerResidents">Dar de alta</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('resident.index') }}">Mostrar lista</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ url('residents/print') }}" target="_blank">Generar reporte de pago</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" onclick="confirm_reset();" style="color: red;">Comienza Mes</a>
            </li>
          </ul>
          
        </div>
      </nav><br>
      <div class="row">
          <div class="col-md-12">
              {{-- <button type="button" class="btn btn-success" id="btn_register"></button> --}}
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#registerCheckin">Registar Entrada</button>
              <button type="button" class="btn btn-danger"data-toggle="modal" data-target="#registerCheckout">Registar Salida</button>
              
          </div>
      </div>
  
  
  <!-- Modal Checkin -->
  <div class="modal fade" id="registerCheckin" tabindex="-1" role="dialog" aria-labelledby="registerCheckin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registerCheckin">Registrar Entrada</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" id="form_checkin">
            @csrf
            <label for="plate">Placa</label>
            <input type="text" name="plate" id="plate" class="form-control" placeholder="Ingresa la placa">
          </form>  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-success" onclick="checkin();">Registrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Checkout -->
  <div class="modal fade" id="registerCheckout" tabindex="-1" role="dialog" aria-labelledby="registerCheckout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registerCheckout">Registrar Salida</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" id="form_checkout">
            @csrf
            <label for="plate">Placa</label>
            <input type="text" name="plate_checkout" id="plate_checkout" class="form-control" placeholder="Ingresa la placa">
          </form>  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-success" onclick="checkout();">Registrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Register Official-->
  <div class="modal fade" id="registerOfficial" tabindex="-1" role="dialog" aria-labelledby="registerOfficial" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registerOfficial">Registrar Vehículo oficial</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" id="form_official">
                @csrf
                <label for="plate">Placa</label>
                <input type="text" name="plate_official" id="plate_official" class="form-control" placeholder="Ingresa la placa">
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-success" onclick="register_official();">Registrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Register Residents-->
  <div class="modal fade" id="registerResidents" tabindex="-1" role="dialog" aria-labelledby="registerResidents" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registerResidents">Registrar Vehículo Residente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" id="form_resident">
                @csrf
                <label for="plate">Placa</label>
                <input type="text" name="plate_resident" id="plate_resident" class="form-control" placeholder="Ingresa la placa">
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-success" onclick="register_resident();">Registrar</button>
        </div>
      </div>
    </div>
  </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        });

    function register_official(){
        var plate_official = document.getElementById("plate_official").value;
        var formOfficial = document.forms['form_official'];
        let _token = formOfficial['_token'].value;

        if (plate_official == "" || plate_official == null) {
            Swal.fire(
            'Error',
            'Ingresa la placa',
            'error'
            )
        }else{
            $.ajax({
                url: '{{ route("official.store") }}',
                method: 'POST',
                data: {
                    plate:plate_official,
                    _token:_token,
                },
            success:function(response){
                $('#registerOfficial').modal('hide');
                document.getElementById("plate_official").value = "";
                if (response == "OK") {
                    Toast.fire({
                    icon: 'success',
                    iconColor: '#F6F6F6',
                    title: '<span style="color:white;">Vehículo Oficial registrado correctamente</span>',
                    background: '#02c31c',
                    })
                }
                },
            error: function (){
                    Toast.fire({
                    icon: 'error',
                    iconColor: '#FFC4B7',
                    title: '<span style="color:white;">Error al registrar vehículo</span>',
                    background: '#02c31c',
                    })
                },
                });
        }
    }

    function register_resident(){
        var plate_resident = document.getElementById("plate_resident").value;
        var formResident = document.forms['form_resident'];
        let _token = formResident['_token'].value;

        if (plate_resident == "" || plate_resident == null) {
            Swal.fire(
            'Error',
            'Ingresa la placa',
            'error'
            )
        }else{
            $.ajax({
                url: '{{ route("resident.store") }}',
                method: 'POST',
                data: {
                    plate:plate_resident,
                    _token:_token,
                },
            success:function(response){
                
                if (response == "OK") {
                  $('#registerResidents').modal('hide');
                  document.getElementById("plate_resident").value = "";

                    Toast.fire({
                    icon: 'success',
                    iconColor: '#F6F6F6',
                    title: '<span style="color:white;">Vehículo Residente registrado correctamente</span>',
                    background: '#02c31c',
                    })
                }
                },
            error: function (){
                    Toast.fire({
                    icon: 'error',
                    iconColor: '#FFC4B7',
                    title: '<span style="color:white;">Error al registrar vehículo</span>',
                    background: '#02c31c',
                    })
                },
                });
        }
    }

    function checkin(){
      var plate = document.getElementById("plate").value;
      var formCheckin = document.forms['form_checkin'];
      let _token = formCheckin['_token'].value;

      if (plate == "" || plate == null) {
          Swal.fire(
          'Error',
          'Ingresa la placa',
          'error'
          )
      }else{
          $.ajax({
              url: '{{ route("identify_plate") }}',
              method: 'POST',
              data: {
                  plate:plate,
                  _token:_token,
              },
          success:function(response){
              $('#registerCheckin').modal('hide');
              document.getElementById("plate").value = "";
              if (response == "OK") {
                  Toast.fire({
                  icon: 'success',
                  iconColor: '#F6F6F6',
                  title: '<span style="color:white;">Entrada registrada correctamente</span>',
                  background: '#02c31c',
                  })
              }
              },
          error: function (){
                  Toast.fire({
                  icon: 'error',
                  iconColor: '#FFC4B7',
                  title: '<span style="color:white;">Error al registrar vehículo</span>',
                  background: '#02c31c',
                  })
              },
              });
        }
    }

    function checkout(){
      var plate = document.getElementById("plate_checkout").value;
      var formCheckout = document.forms['form_checkout'];
      let _token = formCheckout['_token'].value;

      if (plate == "" || plate == null) {
          Swal.fire(
          'Error',
          'Ingresa la placa',
          'error'
          )
      }else{
          $.ajax({
              url: '{{ route("checkout") }}',
              method: 'POST',
              data: {
                  plate:plate,
                  _token:_token,
              },
          success:function(response){
              $('#registerCheckout').modal('hide');
              document.getElementById("plate_checkout").value = "";
              if (response == "OK") {
                Swal.fire(
                'Exito',
                'La salida fue registrada correctamente.',
                'success'
                )
              }else{
                Swal.fire(
                '$'+response,
                'Total a pagar',
                'info'
                )
              }
              },
          error: function (){
                  Toast.fire({
                  icon: 'error',
                  iconColor: '#FFC4B7',
                  title: '<span style="color:white;">Error al registrar vehículo</span>',
                  background: '#02c31c',
                  })
              },
              });
        }
    }

    function confirm_reset(){
      var formCheckout = document.forms['form_checkout'];
      let _token = formCheckout['_token'].value;

      Swal.fire({
      title: '¿Deseas reiniciar los datos?',
      showDenyButton: false,
      showCancelButton: true,
      confirmButtonText: 'Reiniciar mes',
      confirmButtonColor: 'red',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      
      if (result.isConfirmed) {
        $.ajax({
              url: '{{ route("reset_month") }}',
              method: 'POST',
              data: {
                  _token:_token,
              },
          success:function(response){
              
              if (response == "OK") {
                Swal.fire(
                'Exito',
                'El mes se reinicio correctamente.',
                'success'
                )
              }
              },
          error: function (){
                  Toast.fire({
                  icon: 'error',         
                  title: '<span style="color:white;">Error al reiniciar el mes</span>',
                  })
              },
              });
      }
    })
    }
    
    
</script>
</html>