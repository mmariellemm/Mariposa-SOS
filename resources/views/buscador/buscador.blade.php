<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Buscador</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <br><br>
<div style="background-color: aliceblue" class="container shadow">
    <br><br>
    <center><h2>Buscador</h2></center>
    <hr><br>
	<div class="col-md-12">
        <form action="{{action('BuscadorController@inicio')}}" method="POST">
            {{csrf_field()}}
            <input type="text" class="form-control" value="{{$criterio}}" name="criterio" placeholder="Ingrese su busqueda..." ><br>
            <button class="btn btn-success" type="submit"><i class="fas fa-search"></i> Buscar</button>
        </form>
    </div><br>
    <table style="background-color: aliceblue" class="table table-bordered">
        <tr>
            <td>Fecha de registro</td>
            <td>Jugador</td>
            <td>Email</td>
            <td>Foto</td>
            <td>Puntaje</td>
            <td>Personaje</td>
            <td>Imagen</td>
        </tr>
        @foreach($resultados as $elemento)
        <tr>
            <td>{{$elemento->f_registro}}</td>
            <td>{{$elemento->nombrejugador}}</td>
            <td>{{$elemento->email}}</td>
            <td>{{$elemento->foto}}</td> <!-- jugador -->
            <td>{{$elemento->puntaje}}</td>
            <td>{{$elemento->nombrePersonaje}}</td>
            <td>{{$elemento->imagen}}</td> <!-- personaje -->
        </tr>
        @endforeach
    </table>
    <br><br>
</div>
<style>
    body{
        background-color: cadetblue;
    }
</style>

<script src="{{asset('public/jquery.min.js')}}"></script>    
<script src="{{asset('public/bootstrap.min.js')}}"></script>
</body>
</html>