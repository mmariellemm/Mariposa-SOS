<?php
namespace App\BusinessLogic;

use App\Model\Monstruo;
use App\Model\Tesoro;
use App\Model\Danio;
use App\Model\Partida;
use App\Model\DetallePartida;
use Illuminate\Support\Facades\DB;

class BoControlJuego{
    function tirar_dado($num_dados=2){
        if($num_dados==1)
        return rand(1,6);
            else
        return rand(2,12);
    }

    function dame_monstruo($nivel){
        return Monstruo::where('nivel',$nivel)
                        ->inRandomOrder()
                        ->limit(1)
                        ->first();
    }

    function dame_tesoro($nivel){
        return Tesoro::where('nivel', $nivel)
                        ->inRandomOrder()
                        ->limit(1)
                        ->first();
    }


    // function dame_danio($idpersonaje, $idmonstruo){
    function dame_danio($objeto){
        return Danio::where('idpersonaje' ,$objeto->idpersonaje)
                    ->where('idmonstruo' ,$objeto->idmonstruo)
                    ->first();
    }

    function avanzar_turno_actual($idpartida){
        //Determinar cuantos jugadores hay en la partida
        $detalles=DetallePartida::where('idpartida',$idpartida)
                                ->get();
        $numero_jugadores=count($detalles);
            $partida=Partida::find($idpartida);

            if($partida->turno_actual<$numero_jugadores){
                $partida->turno_actual++;
            }
            else{
                $partida->turno_actual=1;
            }

            $partida->save();
    }

    function cerrar_partida($iddetalle_partida){
        $resultado=new \stdClass();
        //1.- Dado un detallepartida obtener el personaje
        //y los datos de la partida
        $info=DB::table('partida')
        ->join('detalle_partida','partida.id','=','detalle_partida.idpartida')
        ->join('personaje','detalle_partida.idpersonaje','=','personaje.id')
        ->join('jugador','detalle_partida.idjugador','=','jugador.id')
        ->select(
            "personaje.nombre as nompersonaje"
            ,"personaje.objetivo"
            ,"jugador.nombre as nomjugador"
            ,"detalle_partida.puntos"
            ,"detalle_partida.idpartida"
            ,"detalle_partida.id"
        )
        ->where('detalle_partida.id',$iddetalle_partida)
        ->first();

        //2.-Valida si los puntos del detallepartida son
        //mayores o iguales al objetivo del personaje
        if($info->puntos>=$info->objetivo){
            //2.1 Si es asi cerramos la partida
            $partida=Partida::find($info->idpartida);
            $partida->status=2;
            $partida->save();
            
            //2.2 Indicamos en el detalle que ya gano
            $detalle=DetallePartida::find($info->id);
            $detalle->gano=1;
            $detalle->save();
            $resultado=new \stdClass();
            $resultado->status='OK';
            $resultado->mensaje='Felicidades!! '.$info->nomjugador.' has ganado con '.$info->nompersonaje.' tienes '.$info->puntos.' puntos';
        }
        else{
            $resultado->status='Not OK';
            $resultado->mensaje='';
        }
        return $resultado;
    }
}