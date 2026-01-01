<?php
namespace App\BusinessLogic;

use Illuminate\Support\Facades\DB;
use App\Model\Partida;
use App\Model\DetallePartida;
use App\Model\Monstruo;
use App\Model\Turno;
use App\Model\Tesoro;
use App\Model\Danio;
use App\Model\Logro;
use App\Model\Jugador;


use App\BusinessLogic\BoControlJuego;

class BoTurno{

    function valida_turno_activo($iddetalle_partida){
        $turno=Turno::where('iddetalle_partida',$iddetalle_partida)
                    ->join('monstruo','monstruo.id','=','turno.idmonstruo')
                    ->join('detalle_partida','detalle_partida.id','=','turno.iddetalle_partida')
                    ->join('personaje','personaje.id','=','detalle_partida.idpersonaje')
                    ->join('jugador','jugador.id','=','detalle_partida.idjugador')
                    ->where('status',1)
                    ->select(
                        "monstruo.nombre as nommonstruo"
                        ,"monstruo.nivel as nivel_monstruo"
                        ,"monstruo.foto as foto_monstruo"
                        ,"turno.idmonstruo"
                        ,"turno.id"
                        ,"turno.iddetalle_partida"
                        ,"detalle_partida.idpersonaje"
                        ,"detalle_partida.idpartida"
                        ,"personaje.nombre as nompersonaje"
                        ,"personaje.imagen as foto_personaje"
                        ,"jugador.nombre as nomjugador"
                        )
                    ->first();
        if($turno){
            return $turno;
        }
        else{
            return false;
        }
    }
    // function crear_turno($nivel,$iddetalle_partida){
    function crear_turno($objeto){
        //1.-Obtener un monstruo aleatorio de acuerdo al nivel
        $bocontrol=new BoControlJuego();
        $monstruo=$bocontrol->dame_monstruo($objeto->nivel);

        //2.-Creo el turno con status 1
        $turno= new Turno();
        $turno->idmonstruo=$monstruo->id;
        $turno->status=1;
        $turno->iddetalle_partida=$objeto->iddetalle_partida;
        $turno->save();
    }

    //function ataque_heroe($danio,$nivel,$iddetalle_partida,$idturno)
    function ataque_heroe($objeto) {
        $resultado = new \stdClass();
        // 1.- Tirar dados
        $bocontrol = new BoControlJuego();
        $dados = 12;  // Supongamos que los dados arrojan 13 en este ejemplo
    
        // 2.- Comparar si el tirar dados >= danio
        if ($dados >= $objeto->danio) {
            $resultado->status = 'OK';
    
            // 2.1 Si es así, ganó el héroe entonces
            // 2.1.1 Obtener el tesoro de acuerdo al nivel
            $tesoro = $bocontrol->dame_tesoro($objeto->nivel);
            $resultado->tesoro = $tesoro;
    
            // 2.2.2 Registro de logro
            $logro = new Logro();
            $logro->idtesoro = $tesoro->id;
            $logro->iddetalle_partida = $objeto->iddetalle_partida;
            $logro->save();
    
            // 2.2.3 Sumar puntos a la partida
            $detalle = DetallePartida::find($objeto->iddetalle_partida);
            $puntosGanados = $tesoro->valor;
    
            // Si el monstruo es de nivel 5 y el héroe tira un 12, todos los jugadores ganan 100 puntos
            if ($objeto->nivel == 5 && $dados == 12) {
                $puntosGanados = 100;
    
                // Actualizar los puntos de todos los jugadores en la partida
                $jugadores = DetallePartida::where('idpartida', $detalle->idpartida)->get();
                foreach ($jugadores as $jugador) {
                    $jugador->puntos += $puntosGanados;
                    $jugador->save();
                }
            }
    
            // Sumar puntos adicionales si existen
            $detalle->puntos = $detalle->puntos + $puntosGanados;
            $detalle->save();
    
            // 2.2.4 Terminar el Turno
            $turno = Turno::find($objeto->idturno);
            $turno->status = 2;
            $turno->save();
    
            // 2.2.5 Avanzar la partida al siguiente turno
            $bocontrol->avanzar_turno_actual($detalle->idpartida);
    
        } else {
            $resultado->status = 'Not OK';
        }
    
        return $resultado;
    }
    
    
    
    

    // function ataque_monstruo($idturno, $idpartida, $iddetalle_partida){
    function ataque_monstruo($objeto){
        $resultado=new \stdClass();
        //1.-Tirar los dados del monstruo
        $bocontrol=new BoControlJuego();
        // $dados=$bocontrol->tirar_dado(2);
        $dados=7;
        $resultado->dados=$dados;
        switch($dados){
            case 7:
            //Me salve
            //3.- Cerrar Turno
            $turno=Turno::find($objeto->idturno);
            $turno->status=2;
            $turno->save();
            //4.- Decirle al juego que aumente el jugador actual
            $bocontrol->avanzar_turno_actual($objeto->idpartida);
            $resultado->mensaje='Te salvaste! Ya no vas a seguir peleando con el monstruo';
            break;
            case 2:
            //Me mori
            //1.-Borrar todos los logros de ese jugador en esa partida (iddetallepartida)
            Logro::where('iddetalle_partida',$objeto->iddetalle_partida)->delete();
            //2.- Poner los puntos en 0 para ese detallepartida
            $detalle=DetallePartida::find($objeto->iddetalle_partida);
            $detalle->puntos=0;
            $detalle->save();
            $resultado->mensaje='Te moriste por bot y has perdido todos tus puntos y logros';
            //3.-Cerrar Turno
            $turno=Turno::find($objeto->idturno);
            $turno->status=2;
            $turno->save();
            //4.- Decirle al juego que aumente el turno actual
            $bocontrol->avanzar_turno_actual($objeto->idpartida);
            break;
            case 3:
            //Estoy herido
            //1.- Borrar todos los logros de ese jugador en esa partida (iddetallepartida)
            Logro::where('iddetalle_partida',$objeto->iddetalle_partida)->delete();
            //2.- Poner los puntos en 0 para ese detallepartida
            $detalle=DetallePartida::find($objeto->iddetalle_partida);
            $detalle->puntos=0;
            $detalle->save();
            //3.-Cerrar el turno
            $turno=Turno::find($objeto->idturno);
            $turno->status=2;
            $turno->save();
            //4.-Decirle al juego que aumente el jugador actual
            $bocontrol->avanzar_turno_actual($objeto->idpartida);
            $resultado->mensaje='Estas herido has perdido todos tus puntos y todos tus logros';
            break;
            
            case 6:
            //Pierdo un tesoro
            //1.-Borrar un solo logro del detallepartida
            $logro=Logro::where('iddetalle_partida',$objeto->iddetalle_partida)->first();
            if($logro){
                $tesoro=Tesoro::find($logro->idtesoro);
                Logro::where('id',$logro->id)->delete();
                //2.-Quitarle los puntos del tesoro removido al detallepartida
                $detalle=DetallePartida::find($objeto->iddetalle_partida);
                $detalle->puntos=$detalle->puntos-$tesoro->valor;
                $detalle->save();
                $resultado->mensaje='Has perdido '.$tesoro->nombre.' y vale '.$tesoro->valor.' ahora tienes '.$detalle->puntos;
            }
            else{
                $resultado->mensaje=' Te ha atacado el monstruo pero no tienes logros ';
            }
            //3.- En este caso no se cierra el turno para que el jugador continue luchando con el monstruo
            //4.-Decirle al juego que aumente el jugador actual
            $bocontrol->avanzar_turno_actual($objeto->idpartida);
            break;
        }
        return $resultado;
    }
}