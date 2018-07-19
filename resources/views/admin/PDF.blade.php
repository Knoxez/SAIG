<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de la Semana</title>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600" rel='stylesheet' type='text/css'>
    <link href="{{ ltrim(elixir('admin/plugins/bootstrap/css/bootstrap.min.css'),'/')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ ltrim(elixir('admin/css/pdf-custom.css'),'/')}}">
</head>
<body>
    <h1>Comida de la Semana ({{$comida->fecha_ini}} al {{$comida->fecha_fin}})</h1>
    <hr>
    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <td>
                    Dia
                </td>
                <td>
                    Menú del día
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Lunes</td>
                <td>
                    <p>{{$comida->monday}}</p>
                </td>
            </tr>
            <tr>
                <td>Martes</td>
                <td>
                    <p>{{$comida->thuesday}}</p>
                </td>
            </tr>
            <tr>
                <td>Miércoles</td>
                <td>
                    <p>{{$comida->wednesday}}</p>
                </td>
            </tr>
            <tr>
                <td>Jueves</td>
                <td>
                    <p>{{$comida->thursday}}</p>
                </td>
            </tr>
            <tr>
                <td>Viernes</td>
                <td>
                    <p>{{$comida->friday}}</p>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
