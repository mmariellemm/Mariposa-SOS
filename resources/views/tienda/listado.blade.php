@extends('master.page')
@section('titulo')
Bienvenido {{$jugador->nombre}} a la tienda de skins
@endsection

@section('contenido')

<div class="row">
    @foreach($skins as $skin)
    <div class="col-12 col-md-12 col-lg-4 mx-auto">
        <div style="background: linear-gradient(to left top, #5AB907 10%, #F8EE25 80%)" class="card text-light text-center bg-white pb-2">
            <div class="card-body text-dark">
                <div class="img-area mb-4">
                    <img src="{{action('SkinController@mostrar_foto', $skin->foto)}}" class="img-fluid" width="150px" height="150px"> <!--ancho/alto-->
                </div>
                <h3 class="card-title">{{$skin->nombre}}</h3>
                
                <h3 class="card-title">{{$skin->precio}} Pesos</h3>
                <p >
                    {{$skin->descripcion}}<br><br>
                    Presumela ahora
                </p>
                <form action="{{ action('PaymentController@formulario') }}" method="get">
                    {{csrf_field()}}
                    <input type="hidden" name="idproducto" value="{{ $skin->id_item }}">
                    <input type="hidden" name="nombreproducto" value="{{ $skin->nombre }}">
                    <input type="hidden" name="dinero" value="{{ $skin->precio }}">
                    <input type="hidden" name="idusuario" value="{{ $usuario->id }}">
                    <button class="btn btn-danger" type="submit">Comprar</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection