@extends('master.page')

@section('titulo')
Crear una Partida
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Crear Partida</h3>
            </div>
        </div>
        <div class="card-body">
            <form action="{{action('JugadorController@guardar_partida')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="exampleInputEmail1" placeholder="Escribe el nombre">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Personaje</label>
                    <select class="form-control" name="idpersonaje" id="">
                        @foreach($personajes as $personaje)
                        <option value="{{$personaje->id}}">{{$personaje->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Codigo</label>
                    <input type="text" class="form-control" name="codigo" id="exampleInputEmail1" placeholder="Escribe el codigo">
                </div>
                <button type="submit" class="btn btn-primary">Crear</button>
            </form>
        </div>
    </div>
</div>
@endsection