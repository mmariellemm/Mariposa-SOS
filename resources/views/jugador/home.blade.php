@extends('master.page')

@section('titulo')
Home {{$jugador->nombre}}
@endsection

@section('contenido')
<div class="row">
    <div class="col'lg'6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Mis partidas</h3>
                    <a href="{{action('JugadorController@crear_sala')}}">Crear Partida</a>
                    <a href="{{action('JugadorController@unir_partida')}}">Unirse a partida</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Personaje</th>
                            <th>Codigo</th>
                            <th>Turno Actual</th>
                            <th>Puntos</th>
                            <th>&nbsp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($partidas as $partida)
                        <tr>
                            <td>
                                {{$partida->nombre}}
                            </td>
                            <td>
                                {{$partida->nompersonaje}}
                            </td>
                            <td>
                                {{$partida->codigo}}
                            </td>
                            <td>
                                {{$partida->turno_actual}}
                            </td>
                            <td>
                                {{$partida->puntos}}
                            </td>
                            <td>
                                @if($partida->status==0)
                                <a href="{{action('JugadorController@iniciar_partida', $partida->id)}}">Iniciar</a>
                                @else
                                    @if($partida->status==1)
                                    <a href="{{action('JugadorController@unir_partida_turno', $partida->id)}}">Reanudar Partida</a>
                                    @else
                                    Terminada
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
        <!--/.card-->
    </div>
    <!-- /.col-md-6-->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Puntos</h3>
                    <!-- <a href="javascrip:void(0);">View Report</a> -->
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">{{$puntos}}</span>
                        <span>Total de Puntos</span>
                    </p>
                </div>

                
                
                <!-- /.d-flex -->
            </div>
        </div>
        <!--/ .card -->
    </div>
    <!--/ .col-md-6 -->
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered" style="max-width: 50px; max-height: 50px;">
            <tr>
                <td>Nombre</td>
                <td>Valor</td>
                <td>Foto</td>
            </tr>
            @foreach ($tesoros as $elemento)
            <tr>
                <td>
                    {{$elemento->nomteso}}
                </td>
                <td>
                    {{$elemento->valor}}
                </td>
                <td>
                    <img class="img-responsive img-circle" src="{{action('TesoroController@mostrar_foto', $elemento->fototeso)}}" alt="">
                </td>
            @endforeach
            </tr>
        </table>
    </div>
</div>

@endsection
</html>
