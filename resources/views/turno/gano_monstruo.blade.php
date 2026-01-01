@extends('master.page')

@section('titulo')
Gano el monstruo
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Perdiste!!!!</h3>
                </div>
            </div>
            <div card-body>
                <h1>{{$mensaje}}</h1>
            </div>
        </div>
    </div>
</div>
@endsection