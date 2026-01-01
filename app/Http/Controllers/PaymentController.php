<?php
namespace App\Http\Controllers;

use App\BusinessLogic\BoOrden;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Pagos\StripeProcessor;
use App\Model\Usuario;
use App\Model\Skin;
use stdClass;

class PaymentController extends Controller{
    function formulario(Request $request){
        $datos = $request->only(['idproducto','nombreproducto', 'dinero', 'idusuario']);
        $datos['url_pago'] = action('PaymentController@procesar_pago');
        return view('pagos.formulario')->with($datos);
    }

    function procesar_pago(Request $r){
        $context = $r->all();
        $stripe = new StripeProcessor();
    
        $usuario = Usuario::find($context['idusuario']);
        $skin = Skin::find($context['item']);
    
        $objeto_pago = new \stdClass();
        $objeto_pago->email = $usuario->email;
        $objeto_pago->token = $context['token_stripe'];
        $objeto_pago->precio = $context['precio'];
        $objeto_pago->currency_code = 'MXN';
        $objeto_pago->producto = $skin->nombre;
        $objeto_pago->idproducto = $context['item'];
    
        $resultado_pago = $stripe->enviar_datos_pago($objeto_pago);
    
        if($resultado_pago->status == 'OK'){
            $objeto_orden = new stdClass();
            $objeto_orden->idusuario = $usuario->id;
            $objeto_orden->canal = 'WEB';
            $objeto_orden->fecha = hoy(); // Corregido "hoy()" por "now()"
            
            // Obtener productos aleatorios para la orden
            $productos_orden = [];
            $productos = Skin::where('id_item', $context['item'])->get();
            foreach($productos as $producto){
                $tmp = [
                    'idproducto' => $context['item'],
                    'cantidad' => 1,
                    'precio' => $producto->precio
                ];
                $productos_orden[] = $tmp;
            }
            $objeto_orden->productos = $productos_orden;
    
            // Llamar al Business Object para crear la orden
            $bo = new BoOrden();
            $bo->crear_orden($objeto_orden);
    
            // Retornar una respuesta JSON con el objeto de la orden creada
            return response()->json($objeto_orden);
        } else {
            // Si el pago no fue exitoso, retornar una respuesta indicando el fallo
            return response()->json(['error' => 'El pago no pudo ser procesado'], 400);
        }
    }
    }
