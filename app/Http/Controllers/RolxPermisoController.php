<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Permiso;
use App\Model\RolxPermiso;

//Esta clase sirve para manejar los datos de la sesion del usuario 
use Illuminate\Support\Facades\Auth;

class RolxPermisoController extends Controller{
    function formulario($id){
        $datos=array();

        $permisos=Permiso::all();

        for($i=0;$i<count($permisos);$i++){
            $tmp=RolxPermiso::where('idrol',$id)->where('idpermiso',$permisos[$i]->idpermiso)->first();
            if($tmp){
                //significa que el rol tiene asignado el permiso
                $permisos[$i]->asignada=true;
            }
            else{
                //significa que el rol no tiene asignado el permiso 
                $permisos[$i]->asignada=false;
            }
        }
        $datos['permisos']=$permisos;
        $datos['idrol']=$id;
        return view('rolxpermiso.formulario')->with($datos);
    }

    function save(Request $r){
        $datos=$r->all();
        //1.Borrar todos los permisos asignados al rol 
        RolxPermiso::where('idrol',$datos['idrol'])->delete();
        if(isset($datos['idpermiso'])){
            foreach($datos['idpermiso'] as $permiso){
                $rxp=new RolxPermiso();
                $rxp->idrol=$datos['idrol'];
                $rxp->idpermiso=$permiso;
                $rxp->save(); 
            }
        }
        return redirect()->route('index_rol');
    }
}