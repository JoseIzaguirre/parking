<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Residentes</title>
    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table{
            font-size: x-small;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }
        .gray {
            background-color: lightgray
        }
    </style>
</head>

<body>
    <table width="100%">
        <tr>
            <td align="right">
                <h3>Reporte de Residentes</h2>    
            </td>
        </tr>
    </table>    
    <br>
      <table width="100%" border="1px" style="border-collapse: collapse;">
        <thead style="background-color: lightgray;">
            <tr>
                <th>Num. Placa</th>
                <th>Tiempo Estacionado (min).</th>
                <th>Total a pagar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $resident)
            <tr>
                <td>{{ $resident->plate }}</td>
                <td>{{ $resident->time }}</td>
                <td>
                    @php
                        echo $resident->time * 0.05;
                    @endphp
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
</body>
</html>