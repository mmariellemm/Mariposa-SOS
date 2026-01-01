<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessLogic\BoEstado;
use App\BusinessLogic\BoOrden;


//Agregarle las librerias para hacer el login
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Model\Jugador;
//Agregarle las librerias para hacer el login

class ApiController extends Controller
{
    //Agregarle las librerias para hacer el login
    use AuthenticatesUsers;

    function objeto_cadena(){
        //Funciones de JSON
        //OBJETO a JSON
        $objeto = new \StdClass();
        $objeto->idmonstruo=1;
        $objeto->nombre='Hombre Lobo';
        $objeto->logros=array();

        $tesoro1=new \stdClass();
        $tesoro1->nombre='Rubi';
        $tesoro2=new \stdClass();
        $tesoro2->nombre='Diamante';
        $objeto->logros[]=$tesoro1;
        $objeto->logros[]=$tesoro2;
        $cadena=json_encode($objeto);
        dd($cadena);
    }


    function cadena_objeto(){
        //funciones de JSON
        //OBJETO a JSON
        $cadena='{"idmonstruo":1,"nombre":"Hombre Lobo","logros":[{"nombre":"Rubi"},{"nombre":"Diamante"}]}';
        $objeto=json_decode($cadena);
        dd($objeto->logros[0]->nombre);

    }

    function guardar_estado(Request $r){
        //Este es guardar

        //cuando es post se usa request y context
        $context=$r->all();
        //dd(context['estado]);
        $objeto=new \stdClass();
        $objeto->idusuario=$context['idusuario'];
        $objeto->idpartida=$context['idpartida'];
        $objeto->json=json_encode($context['json']);
        
        //$objeto->json=json_encode($context['estado']);

        
        $boestado= new BoEstado();
        $boestado->guardar_estado($objeto);
    }



    function obtener_estado(Request $r){
        $context=$r->all();
        //dd($context['estado']);
        $objeto=new \stdClass();
        $objeto->idusuario=$context['idusuario'];
        $objeto->idpartida=$context['idpartida'];
        $boestado=new BoEstado();
        $estado=$boestado->obtener_estado($objeto);
        $resultado=new \stdClass();
        if($estado){
            $resultado->idusuario=$estado->idusuario;
            $resultado->idpartida=$estado->idpartida;
            $resultado->json=json_decode($estado->json); // Aqui debemos decodificar el Json para unity
            $resultado->status='OK';
        }
        else{
            $resultado->status='Not OK';
        }
        return response()->json($resultado);
    }

    function obtener_scores(Request $r){
        
        $boEstado = new BoEstado(); 
        $resultado = [];
    
        $jugadores = Jugador::all(); // Obtener todos los jugadores
    
        foreach ($jugadores as $jugador) {
            $objeto = new \stdClass();
            $objeto->idusuario = $jugador->idusuario;
            $objeto->alias = $jugador->alias;
            
            // Llamar al método obtenerPuntaje de BoEstado para obtener el puntaje del jugador
            $objeto->score = $boEstado->obtener_scores($jugador->idusuario);
            
            $objeto->status = 'OK';
    
            $resultado[] = $objeto;
        }
    
        return response()->json($resultado);
    }

    function guardar_monedas(Request $r){
        //Este es guardar

        //cuando es post se usa request y context
        $context=$r->all();
        //dd(context['estado]);
        $objeto=new \stdClass();
        $objeto->idusuario=$context['idusuario'];
        $objeto->coin=$context['coin'];
        //$objeto->json=json_encode($context['estado']);

        $bomoneda= new BoEstado();
        $bomoneda->guardar_monedas($objeto);
    }

    function obtener_monedas(Request $r){
        $context=$r->all();
        //dd($context['estado']);
        $objeto=new \stdClass();
        $objeto->idusuario=$context['idusuario'];
        $bomoneda=new BoEstado();
        $estado=$bomoneda->obtener_monedas($objeto);
        $resultado=new \stdClass();
        if($estado){
            $resultado->idusuario=$estado->idusuario;
            $resultado->score = $estado->score; // Obtener el puntaje (score) directamente de la base de datos
            $resultado->coin = $estado->coin; 
            $resultado->status='OK';
        }
        else{
            $resultado->status='Not OK';
        }
        return response()->json($resultado);
    }



    //Login laravel
    function login(Request $r){
        $context=$r->all();
        //dd($context);
        $objeto=new \stdClass();
        //Auth::attempt devuelve true o false

        if(Auth::attempt(["email"=>$context['email'],"password"=>$context['password']])){
            $usuario=Auth::getProvider()->retrieveByCredentials(["email"=>$context['email'],"password"=>$context['password']]);
            //dd($usuario);
            $objeto->status = 'OK';
           
            $objeto->perfil = array(
                array(
                    'id' => $usuario->id,
                    'email' => $usuario->email,
                    
                    'idjugador' => dame_jugador()->id,
                    'foto'=> dame_jugador()->foto,
                    'idusuario' => dame_jugador()->idusuario,
                    'nombre' => dame_jugador()->nombre,
                    'alias' => dame_jugador()->alias,
                    'score' => dame_jugador()->score,
                    'coin' => dame_jugador()->coin,
                )
                // Puedes agregar más perfiles si es necesario
            );

        }
        else{
            $objeto->status='Not OK';
        }
        return response()->json($objeto);
    }

    function crear_orden(Request $r){
        $context=$r->all();
        $objeto=new \stdClass();
        $objeto->idusuario=$context['idusuario'];
        $objeto->canal=$context['canal'];
        $objeto->productos=$context['productos'];
        $bo=new BoOrden();
        $bo->crear_orden($objeto);
    }
}