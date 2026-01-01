<?php

namespace App\BusinessLogic;
use App\Model\Monstruo;
use App\Model\Tesoro;
use App\Model\Danio;
use App\Model\DetallePartida;
use App\Model\Partida;
use Illuminate\Support\Facades\DB;
class BoDashboard{

    /*
SELECT DATE_FORMAT (orden.fecha, '%m-%Y') as fecha , 
detalle_orden.idproducto , 
SUM(cantidad)AS total_unidades ,
SUM(cantidad*detalle_orden.precio) AS total_ventas ,
skin.nombre 

FROM orden 
JOIN detalle_orden on orden.id=detalle_orden.idorden 
JOIN skin on skin.id=detalle_orden.idproducto 
WHERE DATE_FORMAT(orden.fecha,'%Y')='2024'
 GROUP BY DATE_FORMAT(orden.fecha, '%m-$Y'),
  detalle_orden.idproducto;
    */
    
function dame_ventas_productos_mes($objeto){
    $consulta=DB::table('orden')
    ->join('detalle_orden', 'orden.id', '=', 'detalle_orden.idorden')
    ->join('skin', 'skin.id_item', '=', 'detalle_orden.idproducto')
    ->select(
        DB::Raw("DATE_FORMAT(orden.fecha, '%m-%Y') as fecha")
        ,DB::Raw("SUM(cantidad) as total_unidades")
        ,DB::Raw("SUM(cantidad*detalle_orden.precio)as total_ventas")

        ,'skin.nombre'
        
        )
        ->groupby(
            DB::Raw("DATE_FORMAT(orden.fecha, '%m-%Y')")
            ,'detalle_orden.idproducto')
            ->whereRaw("DATE_FORMAT(orden.fecha,'%Y')='".$objeto->fecha."'");
if($objeto->canal!=''){
    $consulta->where('orden.canal','=', $objeto->canal);
}
$registros=$consulta->get();

return $registros;
}

/* 
dame total jugador

select COUNT(*) AS total
,jugador.genero
from usuario
join jugador on jugador.idusuario=usuario.id
group by jugador.genero
*/



function dame_ventas_productos_canal($objeto){
/*select 
orden.canal
,SUM(cantidad)AS total_unidades ,
SUM(cantidad*detalle_orden.precio) AS total_ventas 
from orden
JOIN detalle_orden on orden.id=detalle_orden.idorden 
JOIN skin on skin.id=detalle_orden.idproducto 
group by orden.canal; */
$consulta = DB::table('orden')
        ->join('detalle_orden', 'orden.id', '=', 'detalle_orden.idorden')
        ->join('skin', 'skin.id_item', '=', 'detalle_orden.idproducto') // Esta parte se agrega para mantener la consistencia con la consulta SQL proporcionada
        ->select(
            DB::Raw("DATE_FORMAT(orden.fecha,'%m-%Y') as fecha"),
            'detalle_orden.idproducto',
            DB::Raw("SUM(cantidad) as total_unidades"),
            DB::Raw("SUM(cantidad*detalle_orden.precio) as total_ventas"),
            'orden.canal as nombre'
        )
        ->groupBy(
            DB::Raw("DATE_FORMAT(orden.fecha,'%m-%Y')"),
            'orden.canal'
        )
        ->whereRaw("DATE_FORMAT(orden.fecha,'%Y')='".$objeto->fecha."'");

        if ($objeto->canal != '') {
            $consulta->where('orden.canal', '=', $objeto->canal);
        }

        $registros = $consulta->get();
        return $registros;

}

/*   "CONSULTA POR GENERO Y FILTRO POR EDAD"
    SELECT COUNT(*) as total_jugadores ,jugador.edad FROM usuario JOIN jugador on jugador.idusuario = usuario.id GROUP BY jugador.edad; 
    */
    function dame_total_genero($objeto) {
        $consulta = DB::table('usuario')
            ->join('jugador', 'jugador.idusuario', '=', 'usuario.id')
            ->groupBy('jugador.genero')
            ->select(
                'jugador.genero',
                DB::raw("COUNT(*) as total")
            );
            
        if ($objeto->edad != '') {
            $consulta->where('jugador.edad', $objeto->edad);
        }
        if ($objeto->genero != '') {
            $consulta->where('jugador.genero', $objeto->genero);
        }
        
        $registros = $consulta->get();
        return $registros;
    }






/*   "CONSULTA POR EDAD Y FILTRO POR GENERO"
    SELECT COUNT(*) as total_jugadores ,jugador.genero FROM usuario JOIN jugador on jugador.idusuario = usuario.id GROUP BY jugador.genero;
    */
    function dame_total_edad($objeto){
        $edadesconsultas=DB::table('usuario')
        ->join('jugador', 'jugador.idusuario', '=', 'usuario.id')
        ->select("jugador.edad"
        ,DB::Raw("COUNT(*) as total")
        )
        ->groupby('jugador.edad');
        if ($objeto->edad != '') {
            $edadesconsultas->where('jugador.edad', $objeto->edad);
        }
        if ($objeto->genero != '') {
            $edadesconsultas->where('jugador.genero', $objeto->genero);
        }
        
        $registros = $edadesconsultas->get();
        return $registros;
        
    }


}