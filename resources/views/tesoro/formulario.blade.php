@extends('master.page')

@section('titulo')
Formulario de tesoros
@endsection

@section('contenido')

<div class="row">
    <div class="col'lg'6">
            <form action="{{action('TesoroController@operacion')}}" enctype="multipart/form-data" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$tesoro->id}}" />
                <input type="hidden" name="operacion" value="{{$operacion}}" />
                
                
                <label for="">Nombre</label>
                <input type="text" class="form-control" value="{{$tesoro->nombre}}" name="nombre" />

                <label for="">Foto</label>
                @if($tesoro->foto!='')
                <a href="{{action('TesoroController@mostrar_foto', $tesoro->foto)}}">Mostrar foto</a>
                @endif
                <input type="file" class="form-control" accept="image/*" name="foto" />

                <label for="">nivel</label>
                <input type="text" class="form-control" value="{{$tesoro->nivel}}" name="nivel" />

                <label for="">valor</label>
                <input type="text" class="form-control" value="{{$tesoro->valor}}" name="valor" />

                

                <br>
                <button class="btn btn-primary" type="submit">{{$operacion}}</button>
                <br>
                <br>
            </form>
    </div>
</div>
 
@endsection
</html>
