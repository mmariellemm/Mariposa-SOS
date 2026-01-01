@extends('master.page')

@section('titulo')
Listado de personajes
@endsection

@section('contenido')

<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
                <form action="{{action('PersonajeController@formulario')}}" method="POST">
                    {{csrf_field()}}
                    <button class="btn btn-primary" type="submit">Agregar</button>
                </form>

                <table style="background-color: aliceblue" class="table table-bordered">
                    <tr style="text-align: center">
                        <td>Id</td>
                        <td>Nombre</td>
                        <td>imagen</td>
                        <td>Objetivo</td>
                        <td>&nbsp;</td>
                    </tr>
                    @foreach($personajes as $personaje)
                    <tr style="text-align: center">
                        <td>{{$personaje->id}}</td>
                        <td>
                            <a href="{{action('PersonajeController@formulario',$personaje->id)}}">{{$personaje->nombre}}</a>
                        </td>
                        <td>
                            <img class="img-responsive img-circle" src="{{action('PersonajeController@mostrar_imagen', $personaje->imagen)}}" alt="" width="100px" height="100px">
                        </td>
                        <td>
                            <a href="{{action('PersonajeController@formulario',$personaje->id)}}">{{$personaje->objetivo}}</a>
                        </td>
                        <td>
                            <form action="{{action('PersonajeController@operacion')}}" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="id" value="{{$personaje->id}}" />
                                <input type="hidden" name="operacion" value="Eliminar" />
                                <button class="btn btn-danger" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
    </div>
</div>  

@endsection
</html>