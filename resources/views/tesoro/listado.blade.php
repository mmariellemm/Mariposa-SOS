@extends('master.page')

@section('titulo')
Listado de Tesoros
@endsection

@section('contenido')

<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">

        <form action="{{action('TesoroController@formulario')}}" method="POST">
            {{csrf_field()}}
            <button class="btn btn-primary" type="submit">Agregar</button>
        </form>

        <table style="background-color: aliceblue"  class="table table-bordered">
            <tr>
                <td>Id</td>
                <td>Nombre</td>
                <td>Foto</td>
                <td>nivel</td>
                <td>valor</td>
                <td>&nbsp;</td>
            </tr>
            @foreach($tesoros as $tesoro)
            <tr style="text-align: center">
                <td>{{$tesoro->id}}</td>
                <td>
                    <a href="{{action('TesoroController@formulario',$tesoro->id)}}">{{$tesoro->nombre}}</a>
                </td>

                <td>
                    <img class="img-responsive img-circle" src="{{action('TesoroController@mostrar_foto', $tesoro->foto)}}" alt="" width="100px" height="100px">
                </td>
                <td>
                    <a href="{{action('TesoroController@formulario',$tesoro->id)}}">{{$tesoro->nivel}}</a>
                </td>
                <td>
                    <a href="{{action('TesoroController@formulario',$tesoro->id)}}">{{$tesoro->valor}}</a>
                </td>
                <td>
                    <form action="{{action('TesoroController@operacion')}}" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$tesoro->id}}" />
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
