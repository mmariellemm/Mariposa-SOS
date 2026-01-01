@extends('master.page')

@section('titulo')
Formulario de usuarios
@endsection

@section('contenido')

<div class="row">
    <div class="col'lg'6">
        <form action="{{action('UsuarioController@operaciones')}}" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$usuario->id}}">
            <input type="hidden" name="operacion" value="{{$operacion}}">
            <label for="">Email</label>
            <input type="text" name="email" value="{{$usuario->email}}">
            <label for="">Password</label>
            <input type="password" name="password" value="">
            <label for="">Rol</label>
            <select name="idrol" id="">
            @foreach($roles as $rol)
            <?php
            $sel='';
            if ($rol->idrol==$usuario->idrol)
                $sel=' selected ';
            ?>
            <option {{$sel}} value="{{$rol->idrol}}">{{$rol->nomrol}}</option>
            @endforeach
            </select>
            <button type="submit" class="btn btn-primary">{{$operacion}}</button>
        </form>
    </div>
</div>
 
@endsection
</html>