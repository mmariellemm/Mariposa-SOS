@extends('master.page')

@section('titulo')
Formulario de monstruos
@endsection

@section('contenido')

<div class="row">
    <div class="col'lg'6">
            <form action="{{action('MonstruoController@operacion')}}" enctype="multipart/form-data" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$monstruo->id}}" />
                <input type="hidden" name="operacion" value="{{$operacion}}" />
                
                
                <label for="">Nombre</label>
                <input type="text" class="form-control" value="{{$monstruo->nombre}}" name="nombre" />

                <label for="">Foto</label>
                @if($monstruo->foto!='')
                <a href="{{action('MonstruoController@mostrar_foto', $monstruo->foto)}}">Mostrar foto</a>
                @endif
                <input type="file" class="form-control" accept="image/*" name="foto" />

                <label for="">nivel</label>
                <input type="text" class="form-control" value="{{$monstruo->nivel}}" name="nivel" />

                <br>
                <button class="btn btn-primary" type="submit">{{$operacion}}</button>
                <br>
                <br>
            </form>
    </div>
</div>
 
@endsection
</html>
