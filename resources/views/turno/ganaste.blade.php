@extends('master.page')

@section('titulo')
Ganaste!!!
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Has ganado la partida!!!</h3>
                </div>
            </div>
            <div class="card-body">
                {{$resultado->mensaje}}
            </div>
        </div>
    </div>
</div>
@endsection