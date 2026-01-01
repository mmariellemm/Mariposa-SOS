@extends('master.page')
@section('titulo')
    Formulario de Roles
@endsection
@section('contenido')

<div class="row">
    <div class="col'lg'6">
        <form action="{{action('RolController@save')}}" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="idrol" value="{{$rol->idrol}}">
            <input type="hidden" name="operacion" value="{{$operacion}}"><br>
            <label for="">Rol</label>
            <input type="text" name="nomrol" id="{{$rol->nomrol}}">
            <button type="submit" class="btn btn-primary">{{$operacion}}</button>
        
        
        </form>

    </div>
</div>
 
@endsection