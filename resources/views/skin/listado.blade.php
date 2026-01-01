@extends('master.page')

@section('titulo')
Listado de skins
@endsection

@section('contenido')

<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">

        <form action="{{action('SkinController@formulario')}}" method="POST">
            {{csrf_field()}}
            <button class="btn btn-primary" type="submit">Agregar</button>
        </form>

        <table style="text-align: center; background-color: aliceblue;" class="table table-bordered" style="background-color: aliceblue" >
            <tr>
                <td>Id</td>
                <td>Nombre</td>
                <td>Foto</td>   
                <td>Precio</td>
                <td>&nbsp;</td>
            </tr>
            @foreach($skins as $skin)
            <tr style="text-align: center">
                <td>{{$skin->id}}</td>
                <td>
                    <a href="{{action('SkinController@formulario',$skin->id)}}">{{$skin->nombre}}</a>
                </td>

                <td>
                    <img class="img-responsive img-circle" src="{{action('SkinController@mostrar_foto', $skin->foto)}}" alt="" width="100px" height="100px">
                </td>

                <td>
                    <a href="{{action('SkinController@formulario',$skin->id)}}">{{$skin->precio}}</a>
                </td>
                <td>
                    <form action="{{action('SkinController@operacion')}}" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$skin->id}}" />
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
