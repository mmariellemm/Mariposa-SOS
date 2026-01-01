@extends('master.page')

@section('titulo')
Listado de jugadores
@endsection

@section('contenido')

<div class="row">
    <div class="col'lg'6">
            <form action="{{action('JugadorController@operacion')}}" enctype="multipart/form-data" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$jugador->id}}"/>
                <input type="hidden" name="operacion" value="{{$operacion}}" />
                
                
                <label for="">Nombre</label>
                <input type="text" class="form-control" value="{{$jugador->nombre}}" name="nombre" />

                <label for="">Apodo</label>
                <input type="text" class="form-control" value="{{$jugador->alias}}" name="alias" />

                <label for="">Foto</label>
                @if($jugador->foto!='')
                <a href="{{action('JugadorController@mostrar_foto', $jugador->foto)}}">Mostrar foto</a>
                @endif
                <input type="file" class="form-control" accept="image/*" name="foto" />

                <br>
                <button class="btn btn-primary" type="submit">{{$operacion}}</button>
                <br>
                <br>
            </form>
    </div>
</div>
 
@endsection
</html>
