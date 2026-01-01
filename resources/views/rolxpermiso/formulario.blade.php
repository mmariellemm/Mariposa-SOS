@extends('master.page')
@section('titulo')
    Asignacion de permisos
@endsection

@section('contenido')
<div class="row">
    <div class="col'lg'6">
        <form action="{{action('RolxPermisoController@save')}}" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="idrol" value="{{$idrol}}">
            <table style="background-color: whitesmoke" class="table table-hover" class="table table-bordered" >
                @foreach ($permisos as $permiso)
                <tr>
                    <td>
                        <input @if ($permiso->asignada) checked @endif name="idpermiso[]" value="{{$permiso->idpermiso}}" type="checkbox">
                    </td>
                    <td>{{$permiso->nompermiso}} ({{$permiso->cvepermiso}}) {{$permiso->idpermiso}}</td>
                </tr>
                @endforeach
                <button class="btn btn-primary" type="submit">Asignar Permiso</button>
            </table>
        
        </form>
    
    </div>
</div>

    

@endsection