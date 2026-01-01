@extends('master.page')

@section('titulo')
Listado de Usuarios
@endsection

@section('contenido')

<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <form action="{{action('UsuarioController@formulario')}}" method="POST">
            {{csrf_field()}}
            <button class="btn btn-primary" type="submit">Agregar</button>
        </form>
        <table style="background-color: aliceblue" class="table table-bordered">
            <tr>
                <td>id</td>
                <td>Nombre</td>
                <td>Rol</td>
                <!--<td>Edad</td>
                <td>Genero</td> -->
                <td>Foto</td>
                <td>&nbsp;</td>
            </tr>
            @foreach($usuarios as $usuario)
            <tr style="text-align: center">
                <td>{{$usuario->id}}</td>
                <td>
                    <a href="{{action('UsuarioController@formulario', $usuario->id)}}">{{$usuario->email}}</a>
                </td>
                <td>{{$usuario->nomrol}}</td>
                
                <!--<td>
                    <a >{{$usuario->edad}}</a>
                </td>
                <td>
                    <a>{{$usuario->genero}}</a>
                </td> -->
            <!--<td>
                    <img class="img-responsive img-circle" src="{{action('UsuarioController@mostrar_foto', $usuario->foto)}}" alt="" width="100px" height="100px">
                </td>-->
                <td>
                    <form action="{{action('UsuarioController@operaciones')}}" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$usuario->id}}">
                        <input type="hidden" name="operacion" value="Eliminar">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

@endsection
</html>