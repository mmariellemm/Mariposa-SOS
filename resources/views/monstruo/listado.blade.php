@extends('master.page')

@section('titulo')
Listado de Monstruos
@endsection

@section('contenido')

<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">

        <form action="{{action('MonstruoController@formulario')}}" method="POST">
            {{csrf_field()}}
            <button class="btn btn-primary" type="submit">Agregar</button>
        </form>

        <table style="background-color: aliceblue"  class="table table-bordered">
            <tr>
                <td>Id</td>
                <td>Nombre</td>
                <td>Foto</td>
                <td>nivel</td>
                <td>&nbsp;</td>
            </tr>
            @foreach($monstruos as $monstruo)
            <tr style="text-align: center">
                <td>{{$monstruo->id}}</td>
                <td>
                    <a href="{{action('MonstruoController@formulario',$monstruo->id)}}">{{$monstruo->nombre}}</a>
                </td>

                <td>
                    <img class="img-responsive img-circle" src="{{action('MonstruoController@mostrar_foto', $monstruo->foto)}}" alt="" width="100px" height="100px">
                </td>
                <td>
                    <a href="{{action('MonstruoController@formulario',$monstruo->id)}}">{{$monstruo->nivel}}</a>
                </td>
                <td>
                    <form action="{{action('MonstruoController@operacion')}}" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$monstruo->id}}" />
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
