<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Vehículos Residentes</title>
</head>
<body>
      <div class="row">
        
              
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h4 style="text-align: center;">Vehículos Residentes</h4>
                <a href="{{ url('/') }}" class="btn btn-secondary">Regresar</a><br><br>
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th>ID</th>
                        <th>PLACA</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($residents as $resident)
                      <tr>
                        <td>{{$resident->id}}</td>
                        <td>{{$resident->plate}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {!! $residents->links() !!}
            </div>
          
      </div>


</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
