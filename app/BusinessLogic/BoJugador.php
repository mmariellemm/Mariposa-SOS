<?php
namespace App\BusinessLogic;

use Illuminate\Support\Facades\DB;

class BoJugador{

    //Dado un jugador dame sus salas
    /*
        select *
    from partida
    join detalle_partida on partida.id=detalle_partida.idpartida
    where detalle_partida.idjugador=1
    */

    function damete($id){
        return DB::table('partida')
        ->select(
            "partida.nombre as nompar"
            ,"tesoro.nombre as nomteso"
            ,"tesoro.foto as fototeso"
            ,"tesoro.valor"
        )
        ->join('detalle_partida','partida.id', '=', 'detalle_partida.idpartida')
        ->join('personaje','personaje.id', '=', 'detalle_partida.idpersonaje')
        ->join('logro','logro.iddetalle_partida', '=', 'detalle_partida.id')
        ->join('tesoro','tesoro.id', '=', 'detalle_partida.idpartida')
        ->where('detalle_partida.idjugador',$id)
        ->get();
    }



    //Metodo para listar cosas de la bd
    function dame_partidas_jugador($idjugador){
        return DB::table('partida')
        ->select(
            "partida.nombre"
            ,"partida.codigo"
            ,"partida.id"
            ,"partida.status"
            ,"partida.turno_actual"
            ,"detalle_partida.puntos"
            ,DB::Raw("personaje.nombre as nompersonaje")
        )
    ->join('detalle_partida','partida.id','=','detalle_partida.idpartida')
    ->join('personaje','personaje.id','=','detalle_partida.idpersonaje')
    ->where('detalle_partida.idjugador',$idjugador)
    ->get();
    }

    

    //Opcion 1 es hacer la suma desde la consulta
    /*
    select SUM(puntos) as total_puntos
    from detalle_partida where detalle_partida.idjugador=1
    */
    function obtener_total_puntos_1($idjugador){
        $total=DB::table('detalle_partida')
                ->select(
                    DB::Raw("SUM(puntos) as total_puntos")
                )
                ->where('idjugador',$idjugador)
                ->first();
        if($total->total_puntos){
            //Si la consulta obtuvo informacion entonces 
            //devuelve los puntos
            return $total->total_puntos;
        }
        else{
            //Si la consulta no devolvio informacion entonces
            //Devuelto los puntos
            return 0;
        }
    }
    

    //Opcion 2 es hacer la suma desde el php o la programacion
    function obtener_total_puntos_2($idjugador){
        $total=0;
        $registros=DB::table('detalle_partida')
                ->select("puntos"
                )
                ->where('idjugador',$idjugador)
                ->get();
        foreach($registros as $elemento){
            $total=$total+$elemento->puntos;
        }

        return $total;
    }

    //select * from skins_usuario
    //join skin on skin.id_item=skins_usuario.idskin
    //where skins_usuario.idusuario=41;

    function dameskin($id){
        return $skins = DB::table('skins_usuario as skinusu')
        ->select(
            'skin1.id_item as idskin',
            'skin1.nombre as nomskin',
            'skin1.foto as fotoskin',
            'skin1.precio as precioskin'
        )
        ->join('skin as skin1', 'skinusu.idskin', '=', 'skin1.id_item')
        ->where('skinusu.idusuario', $id)
        ->get();

    }


}