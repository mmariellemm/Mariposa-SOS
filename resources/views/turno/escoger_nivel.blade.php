@extends('master.page')

@section('titulo')
Seleccion de nivel
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Escoger el nivel del monstruo</h3>
                </div>
            </div>
            <div class="card-body">
                <form action="{{action('JugadorController@crear_turno')}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="iddetallepartida" value="{{$iddetallepartida}}">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nivel</label>
                        <select class="form-control" name="idnivel" id="">
                            <option value="1">Nivel 1</option>
                            <option value="2">Nivel 2</option>
                            <option value="3">Nivel 3</option>
                            <option value="4">Nivel 4</option>
                            <option value="5">Nivel 5</option>
                            <option value="6">Nivel 6</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Seleccionar</button>                
                </form>
            </div>
        </div>
    </div>
</div>
@endsection