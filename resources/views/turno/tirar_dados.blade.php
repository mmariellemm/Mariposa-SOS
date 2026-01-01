@extends('master.page')

@section('titulo')
Tirar dados
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Turno actual</h3>
                </div>
            </div>
            <div class="card-body">
                Estas jugando como <b>{{$turno->nompersonaje}}</b><br>
                <img class="img-responsive img-circle" src="{{action('PersonajeController@mostrar_imagen', $turno->foto_personaje)}}" alt="" width="50px" height="50px">
                <br><br>
                Juegas contra <b>{{$turno->nommonstruo}}</b><br>
                <img class="img-responsive img-circle" src="{{action('MonstruoController@mostrar_foto', $turno->foto_monstruo)}}" alt="" width="50px" height="50px">
                <br><br>
                Necesitas tirar <b>{{$danio->valor}}</b>
                <form action="{{action('JugadorController@tirar_dados')}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="danio" value="{{$danio->valor}}">
                    <input type="hidden" name="nivel" value="{{$turno->nivel_monstruo}}">
                    <input type="hidden" name="iddetallepartida" value="{{$turno->iddetalle_partida}}">
                    <input type="hidden" name="idturno" value="{{$turno->id}}">
                    <input type="hidden" name="idpartida" value="{{$turno->idpartida}}">
                    <button class="btn btn-info">Tirar dados</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection