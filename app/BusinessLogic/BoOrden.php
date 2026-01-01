<?php
namespace App\BusinessLogic;

use Illuminate\Support\Facedes\DB;
use App\Model\Orden;
Use App\Model\DetalleOrden;
Use App\Model\SkinUsuario;

class BoOrden{


    function crear_orden($objeto){
        //1.-Insertar una orden
        $orden = new Orden();
        $orden->idusuario=$objeto->idusuario;
        if(isset($objeto->fecha))
            $orden->fecha=$objeto->fecha;
        else
        $objeto->fecha=hoy();
        //$orden->fecha=hoy
        // $orden->status=$objeto->status;
        $orden->status=1;
        $orden->canal=$objeto->canal;
        $orden->idsucursal=0;
        $orden->save();

        //2.- Detalle de la orden
        foreach ($objeto->productos as $producto){
            $detalle = new DetalleOrden();
            //Arreglo Array
            //$detalle->idproducto=$producto->idproducto;

            $detalle->idproducto =$producto['idproducto'];
            $detalle->cantidad=$producto['cantidad'];
            $detalle->precio=$producto['precio'];
            $detalle->idorden=$orden->id;
            $detalle->save();


            $skin = new SkinUsuario();
            $skin->idskin=$producto['idproducto'];
            $skin->idusuario=$objeto->idusuario;
            $skin->idorden=$orden->id;
            $skin->save();
        }

    }
}

?>
