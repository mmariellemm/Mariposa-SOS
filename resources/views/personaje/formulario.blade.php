@extends('master.page')

@section('titulo')
Formulario de personajes
@endsection

@section('contenido')

<div class="row">
    <div class="col'lg'6">
            <form action="{{action('PersonajeController@operacion')}}" enctype="multipart/form-data" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$personaje->id}}" />
                <input type="hidden" name="operacion" value="{{$operacion}}" />


                <label for="">Nombre</label>
                <input type="text" class="form-control" value="{{$personaje->nombre}}" name="nombre" />

                <label for="">Imagen</label>
                @if($personaje->imagen!='')
                <a href="{{action('PersonajeController@mostrar_imagen', $personaje->imagen)}}">Mostrar imagen</a>
                @endif
                <input type="file" class="form-control" accept="image/*" name="imagen" />

                <label for="">Objetivo</label>
                <input type="text" class="form-control" value="{{$personaje->objetivo}}" name="objetivo" />

                <br>
                <button class="btn btn-primary" type="submit">{{$operacion}}</button>

            </form>
            <br>

    </div>
</div>
    
@endsection
</html>