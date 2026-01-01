<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Listado de salas</title>
    <link rel="stylesheet" href="{{ asset('public/bootstrap.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div  style="background-color: aliceblue" class="container">
        <h1 style="text-align: center">Listado de salas</h1>
        <div class="row">
            <div class="col-md-12">
                <form action="{{action('SalaController@formulario')}}" method="POST">
                    {{csrf_field()}}
                    <button class="btn btn-info" type="submit">Agregar</button>
                </form>

                <table class="table table-bordered">
                    <tr style="text-align: center">
                        <td>Id</td>
                        <td>Nombre</td>
                        <td>&nbsp;</td>
                    </tr>
                    @foreach($salas as $sala)
                    <tr style="text-align: center">
                        <td>{{$sala->id_sala}}</td>
                        <td>
                            <a href="{{action('SalaController@formulario',$sala->id_sala)}}">{{$sala->nombre}}</a>
                        </td>
                        <td>
                            <form action="{{action('SalaController@operacion')}}" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="id_sala" value="{{$sala->id_sala}}" />
                                <input type="hidden" name="operacion" value="Eliminar" />
                                <button class="btn btn-danger" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>  
    <style>
        body{
            background-color: cadetblue;
        }
    </style>

    <script src="{{ asset('public/jquery.min.js') }}"></script>
    <script src="{{ asset('public/bootstrap.min.js') }}"></script>
</body>
</html>
