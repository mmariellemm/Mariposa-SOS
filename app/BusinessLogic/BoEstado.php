<?php
namespace App\BusinessLogic;

use Illuminate\Support\Facades\DB;
use App\Model\Estado;
use App\Model\Jugador;

class BoEstado{
    function guardar_estado($objeto){
        //validando si existe un estado asociado a un usuario
        $estado=Estado::where('idusuario', $objeto->idusuario)->first();
        if(!$estado){
            $estado=new Estado();
        }
        $estado->idusuario=$objeto->idusuario;
        $estado->idpartida=$objeto->idpartida;
        $estado->json=$objeto->json;
        $estado->fecha=hoy();
        $estado->save();
    }
    function obtener_estado($objeto){
        $estado=Estado::where('idusuario', $objeto->idusuario)
                      ->where('idpartida', $objeto->idpartida)
                      ->first();
        return $estado;
    }

    function guardar_monedas($objeto)
    {
        // Obteniendo el jugador asociado al usuario
        $jugador = Jugador::where('idusuario', $objeto->idusuario)->first();
    
        // Calculando el nuevo puntaje basado en las monedas (doble de las monedas)
        $nuevoPuntaje = $objeto->coin * 2;
    
        if ($jugador) {
            // Si el jugador ya existe, verificamos si el nuevo puntaje es mayor
            if ($nuevoPuntaje > $jugador->score) {
                // Si el nuevo puntaje es mayor, actualizamos el puntaje y las monedas
                $jugador->score = $nuevoPuntaje;
                $jugador->coin = $objeto->coin;
                $jugador->save();
            }
        } else {
            // Si el jugador no existe, creamos uno nuevo con el puntaje actual
            $jugador = new Jugador();
            $jugador->idusuario = $objeto->idusuario;
            $jugador->score = $nuevoPuntaje;
            $jugador->coin = $objeto->coin;
            $jugador->save();
        }
    }
    

    function guardar_monedas2($objeto){
        //Validando si existe un estado asociado a un usuario
      $idUsuario = $objeto->idusuario;
      $nuevosPuntos = $objeto->coin;
      $score = $nuevosPuntos * 2; // Multiplicar las monedas por 2 para obtener el nuevo score

     $monedas = Jugador::where('idusuario', $idUsuario)->first();

    //Condicional para sumar las monedas
    if ($monedas){
        //Si ya tenemos monedas, sumamos
        $puntosActuales = $monedas->coin;
        $puntosActualesChk = $puntosActuales - $puntosActuales;
        $puntosTotales = $puntosActualesChk + $nuevosPuntos; // Sumar las monedas
        $monedas->coin = $puntosTotales;
    } else {
        //Si no teníamos monedas, creamos uno a partir del idusuario
        $monedas = new Jugador();
        $monedas->idusuario = $idUsuario;
        $puntosTotales = $nuevosPuntos;
        $monedas->coin = $puntosTotales;
    }

    $monedas->score = $score; // Actualizar el score
    $monedas->save();

    }

    
    function obtener_monedas($objeto){
        $monedas=Jugador::where('idusuario', $objeto->idusuario)
                      ->first();
        return $monedas;
    }

    public function obtener_scores($idUsuario) 
    { // Obtener los puntajes del jugador por su ID de usuario 
        $jugador = Jugador::where('idusuario', $idUsuario)->first();
        return $jugador ? $jugador->score : null;
    }
    

}