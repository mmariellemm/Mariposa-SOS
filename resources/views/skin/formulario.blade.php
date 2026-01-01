@extends('master.page')

@section('titulo')
Formulario de skins
@endsection

@section('contenido')

<div class="row">
    <div class="col'lg'6">
            <form action="{{action('SkinController@operacion')}}" enctype="multipart/form-data" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$skin->id}}" />
                <input type="hidden" name="operacion" value="{{$operacion}}" />
                
                
                <label for="">Nombre</label>
                <input type="text" class="form-control" value="{{$skin->nombre}}" name="nombre" />

                <label for="">Foto</label>
                @if($skin->foto!='')
                <a href="{{action('SkinController@mostrar_foto', $skin->foto)}}">Mostrar foto</a>
                @endif
                <input type="file" class="form-control" accept="image/*" name="foto" />

                <label for="">Precio</label>
                <input type="text" class="form-control" value="{{$skin->precio}}" name="precio" />

                

                <br>
                <button class="btn btn-primary" type="submit">{{$operacion}}</button>
                <br>
                <br>
            </form>
    </div>
</div>
 
@endsection
</html>
