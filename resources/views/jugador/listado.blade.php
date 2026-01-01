@extends('master.page')

@section('titulo')
Listado de jugadores
@endsection

@section('contenido')

<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">

        <form action="{{action('JugadorController@formulario')}}" method="POST">
            {{csrf_field()}}
            <button class="btn btn-primary" type="submit">Agregar</button>
        </form>

        <table style="background-color: aliceblue"  class="table table-bordered">
            <tr style="text-align: center">
                <td>Id</td>
                <td>Id usuario</td>
                <td>Nombre</td>

                <td>Apodo</td>
                <td>&nbsp;</td>
            </tr>
            @foreach($jugadores as $jugador)
            <tr style="text-align: center">
                <td>{{$jugador->id}}</td>
                <td>{{$jugador->idusuario}}</td>
                <td>
                    <a href="{{action('JugadorController@formulario',$jugador->id)}}">{{$jugador->nombre}}</a>
                </td>

                <td>
                    <img class="img-responsive img-circle" src="{{action('JugadorController@mostrar_foto', $jugador->foto)}}" alt="" width="100px" height="100px">
                </td>
                <td>
                    <a href="{{action('JugadorController@formulario',$jugador->alias)}}">{{$jugador->alias}}</a>
                </td>
                <td>
                    <form action="{{action('JugadorController@operacion')}}" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$jugador->id}}" />
                        <input type="hidden" name="operacion" value="Eliminar" />
                        <button class="btn btn-danger " type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>

    </div>
</div>

@endsection
</html>
