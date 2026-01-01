@extends('master.page')

@section('titulo')
Sala de espera
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Sala de espera</h3>
                </div>
            </div>
            <div class="card-body">No es tu turno, le toca a <b>{{$jugador_actual->nomjugador}}</b> y esta jugando como <b>{{$jugador_actual->nompersonaje}}</b><br>
                <img class="img-responsive img-circle" src="{{action('PersonajeController@mostrar_imagen', $jugador_actual->foto_personaje)}}" alt="" width="100px" height="100px">        
        
            </div>
        </div>
    </div>
</div>
@endsection