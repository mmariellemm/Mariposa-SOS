@extends('master.page')

@section('titulo')
Perfil de {{$jugador->nombre}}
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body" >
                <div class="text-center">
                    <td>
                        <img class="img-responsive img-circle" src="{{action('JugadorController@mostrar_foto', $jugador->foto)}}" alt="" width="100px" height="100px">
                    </td>
                    <h3 class="text-center">Datos Personales</h3>
                    <h5 class="mt-3">Nombre: {{$jugador->nombre}}</h5>
                    <p>Apodo: {{$jugador->alias}}</p>

                    <a class="text-center" href="{{action('JugadorController@formulario',$jugador->id)}}">Modificar los datos</a>
                </div>
                <hr>
                <div>
                    <h3 class="text-center">Información</h3>
                    <div class="text-center">
                        <ul class="list-unstyled">
                            <li>Genero: {{$jugador->genero}}</li>
                            <li>Edad: {{$jugador->edad}}</li>
                            <li>Monedas: {{$jugador->coin}}</li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>



    

    

</div>
@endsection
