@extends('master.page')
@section('titulo')
Lista de roles
@endsection

@section('contenido')
<div class="row">
    <div class="col'lg'6">
            <form action="{{action('RolController@formulario')}}" method="POST">
                {{csrf_field()}}
                <button class="btn btn-primary"> Agregar</button>
            </form>
        </div>
    </div>
    <div id="app" class="row">
        <div class="col-md-12 col-xs-12 col-sm-12">
            <table style="background-color: aliceblue"  class="table table-bordered" >
                <tr>
                    <th>Nombre</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                @foreach($lista as $rol)
                <tr>
                    <td><a href="{{action('RolController@formulario', $rol->idrol)}}">{{$rol->nomrol}}</a>
                    </td>
                    <td><a href="{{action('RolxPermisoController@formulario', $rol->idrol)}}">Permisos</a>
                    </td>
                    <td>
                        <form action="{{action('RolController@save')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="idrol" value="{{$rol->idrol}}"/>
                            <input type="hidden" name="operacion" value="Eliminar"/>
                            <button class="btn btn-danger" type="submit"> Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>

        </div>
    </div>
    
@endsection
</html>