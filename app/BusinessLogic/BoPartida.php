<?php
namespace App\BusinessLogic;

use Illuminate\Support\Facades\DB;
use App\Model\Partida;
use App\Model\DetallePartida;

class BoPartida{

    //Como insertar 2 tablas al mismo tiempo
    // function crear_partida($nombre,$codigo,$idjugador,$idpersonaje){
    function crear_partida($objeto){
        //Crear la partida
        $partida=new Partida();
        $partida->nombre=$objeto->nombre;
        $partida->codigo=$objeto->codigo;
        $partida->fecha=hoy();
        $partida->status=0;
        $partida->turno_actual=1;
        $partida->turno_actual=0;
        $partida->save();

        //Inscribir al usuario en la partida
        $detalle=new DetallePartida();
        $detalle->idpartida=$partida->id;
        $detalle->idjugador=$objeto->idjugador;
        $detalle->idpersonaje=$objeto->idpersonaje;
        $detalle->puntos=0;
        $detalle->gano=0;
        $detalle->turno=0;
        $detalle->save();   
    }
    // function unir_partida($idjugador,$idpersonaje,$codigo){
        function unir_partida($objeto){
            $resultado=new \stdClass();
            //Validar si existe una partida con el codigo proporcionado
            $partida=Partida::where('codigo',$objeto->codigo)->first();
            //Si existe entonces continuo
            if($partida){
                //Si existe entonces
                //Valido que para esa partida no haya un jugador que se haya unido con ese personaje
                $detalle=DetallePartida::where('idpartida',$partida->id)
                                        ->where('idpersonaje',$objeto->idpersonaje)
                                        ->first();
                if($detalle){
                    //Si existe significa que ya me ganaron el personaje
                    $resultado->status='Not OK';
                $resultado->mensaje='Para esta partida ya se inscribio un jugador con el personaje seleccionado';
                }
                else{
                    //Si no existe registro al jugador en la partida con el personaje
                    //que se pidio
                    $detalle=new DetallePartida();
                $detalle->idpartida=$partida->id;
                $detalle->idjugador=$objeto->idjugador;
                $detalle->idpersonaje=$objeto->idpersonaje;
                $detalle->puntos=0;
                $detalle->gano=0;
                $detalle->turno=0;
                $detalle->save();
                $resultado->status='OK';
                $resultado->mensaje='';
                }
            }
            else{
                //No existe una partida con el codigo proporcionado
                $resultado->status='Not OK';
                $resultado->mensaje='No existe una partida con el codigo ';
            }
            return $resultado;
        }
        function iniciar_partida($idpartida){
            //Cambiar el status de la partida en 1
            $partida=Partida::find($idpartida);
            $partida->status=1;
            $partida->turno_actual=1;
            $partida->save();


            //Determina cuantos jugadores hay en la partida
            $detalles=DetallePartida::where('idpartida',$partida->id)
                                    ->get();
            $numero_jugadores=count($detalles);

            //Generar los turnos y revolverlos
            $turnos=range(1,$numero_jugadores);
            shuffle($turnos);

            //Asigno los turnos al detalle
            $indice_turno=0;
            foreach($detalles as $detalle){
                $detalle->turno=$turnos[$indice_turno];
                $detalle->save();
                $indice_turno++;
            }
        }

    //function valida_turno_jugador($idpartida,$idjugador){
    function valida_turno_jugador($objeto){
        $resultado=new \stdClass();
        //1.-Dada la partida obtener el turno actual
        $partida=Partida::find($objeto->idpartida);
        //2.-Obtener dada la partida y el jugador el turno que le toco
        $detalle=DetallePartida::where('idpartida',$objeto->idpartida)
                        ->where('idjugador',$objeto->idjugador)
                        ->first();
        //3.-Preguntar si el turno actual de la partida es igual al turno del jugador
        if($partida->turno_actual==$detalle->turno){
            //3.1 Si es igual entonces significa que es su turno
            $resultado->status='OK';
            $resultado->detallepartida=$detalle;
        }
        else{
            //3.2 Si no es igual significa  que NO es su turno
            $resultado->status='Not OK';
        }

        return $resultado;
    }

    function obtener_jugador_actual($idpartida){
        return DB::table('partida')
        ->join('detalle_partida','partida.id','=','detalle_partida.idpartida')
        ->join('personaje','detalle_partida.idpersonaje','=','personaje.id')
        ->join('jugador','detalle_partida.idjugador','=','jugador.id')
        ->select(
            "personaje.nombre as nompersonaje"
            ,"jugador.nombre as nomjugador"
            ,"detalle_partida.idpersonaje"
            ,"personaje.imagen as foto_personaje"
            ,"detalle_partida.idjugador"
            )
        ->where('partida.id',$idpartida)
        ->whereRaw('partida.turno_actual=detalle_partida.turno')
        ->first();
    }
}