@extends('master.page')

@section('titulo')
<h2>Mensaje</h2>
@endsection

@section('contenido')

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Aviso!</h3>
                </div>
            </div>
            <div class="card-body">
                {{$mensaje}}
            </div>
        </div>
    </div>
</div>

@endsection