<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Buscador;
use Illuminate\Support\Facades\DB;
//permite importar facade que es un generador de consultas db


class BuscadorController extends Controller
{

    /*
        SELECT bd_proyecto.f_registro
	        ,jugador.nombre
            ,jugador.email
            ,jugador.foto
            ,jugador.puntaje
        FROM bd_proyecto
        JOIN personaje ON personaje.id_personaje=bd_proyecto.id_personaje
        JOIN jugador ON jugador.id_jugador=bd_proyecto.id_jugador
    */
    
    //$r son los $datos
    //array es para almacenar datos
    function inicio (Request $r){
        $context=$r->all();
        $datos=array();
        if(isset($context['criterio'])){ //si tiene "criterio
          $registros=DB::table('bd_proyecto') //realiza la consulta
            ->join('personaje','personaje.id_personaje','=','bd_proyecto.id_personaje')   //Join son para unir diferentes tablas de la base de datos
            ->join('jugador','jugador.id_jugador','=','bd_proyecto.id_jugador')
            ->select( //Es para consultar y recuperar de la info de la bd               DB::RAW se uso para renombrar
                'bd_proyecto.f_registro'
                ,DB::RAW('jugador.nombre as nombrejugador')
                ,'jugador.email'
                ,'jugador.puntaje'
                ,'jugador.foto'
                 ,DB::RAW('personaje.nombre as nombrePersonaje')
                 ,'personaje.imagen'
            )
            //busca registros en base al criterio dado
            ->whereRaw("jugador.nombre like '%".$context['criterio']."%' 
                    or personaje.nombre like '%".$context['criterio']."%'
                    or personaje.imagen like '%".$context['criterio']."%'")
            ->get();
            $datos=array();
            $datos["resultados"]=$registros;
            $datos["criterio"]=$context['criterio'];
        }
        else{
            $datos['criterio']='';
            $datos['resultados']=array();
        }
        return view('buscador.buscador')->with($datos);
    }
}