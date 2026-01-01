@extends('master.page')

@section('titulo')
Gano el heroe
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Ganaste!!!!</h3>
                </div>
            </div>
            <div class="card-body">Ganaste al monstruo <b></b> y ganaste el tesoro <b>{{$tesoro->nombre}}</b> que vale {{$tesoro->valor}}
                <img class="img-responsive img-circle" src="{{action('TesoroController@mostrar_foto', $tesoro->foto)}}" alt="" width="50px" height="50px">    
            </div>

        </div>
    </div>
</div>
@endsection