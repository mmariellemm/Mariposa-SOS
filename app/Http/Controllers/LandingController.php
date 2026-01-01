<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Model\Jugador;
use App\BusinessLogic\BoJugador;
use Illuminate\Support\Facades\Auth;


class LandingController extends Controller{

    function regresar(){
        return view ('landing.page');
    }


    function home(){
        $datos=array();
        $idusuario=Auth::user()->id;
        $jugador=Jugador::where('idusuario',$idusuario)->first();
        $datos['jugador']=$jugador;
        return view('landing.page')->with($datos);
    }
}

?>