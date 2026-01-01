@extends('master.page')

@section('titulo')
Unirse a partida
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Unir Partida</h3>
                </div>
            </div>
            <div class="card-body">
                <form action="{{action('JugadorController@unir_partida_save')}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Codigo</label>
                        <input type="text" name="codigo" class="form-control" id="exampleInputEmail1" placeholder="Escribe el nombre">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Personaje</label>
                        <select class="form-control" name="idpersonaje" id="">
                            @foreach($personajes as $personaje)
                            <option value="{{$personaje->id}}">{{$personaje->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear</button>                
                </form>
            </div>
        </div>
    </div>
</div>
@endsection