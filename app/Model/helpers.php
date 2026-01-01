<?php

use App\Model\Jugador;

use App\Model\Skin;
use App\Model\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function hoy($formato='Y-m-d H:i:s'){
    date_default_timezone_set("America/Merida");
    return date($formato);
}

function dame_usuario(){
    return Auth::user();
}



function dame_usuario2(){
    $idusuario = Auth::user()->id;
    $usuario=Usuario::where('id',$idusuario)->first();
    return $usuario;
}
function valida_permiso_usuario($cvepermiso){
    $permiso=DB::table('usuario')
        ->join('rol','rol.idrol','=','usuario.idrol')
        ->join('rolxpermiso','rol.idrol','=','rolxpermiso.idrol')
        ->join('permiso','rolxpermiso.idpermiso','=','permiso.idpermiso')
        ->where('usuario.id',Auth::user()->id)
        ->where('permiso.cvepermiso',$cvepermiso)
        ->get();
    if(count($permiso)!=0){
        return true;
    }
    else{
        return false;
    }
}

function dame_jugador(){
    $idusuario=Auth::user()->id;
    $jugador=Jugador::where('idusuario',$idusuario)->first();
    return $jugador;
}






