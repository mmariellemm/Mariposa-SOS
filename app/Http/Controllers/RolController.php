<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Rol;
use App\Model\RolxPermiso;
use Illuminate\Support\Facades\Auth;

class RolController extends Controller{

    public function listado(){
        $roles = Rol::all();
        $datos = array();
        $datos['lista'] = $roles;
        return view('rol.listado')->with($datos);
    }

    public function formulario($idrol = 0){
        if($idrol == 0){
            $operacion = 'Agregar';
            $rol = new Rol();
        }
        else{
            $operacion = 'Editar';
            $rol = Rol::find($idrol);
        }

        $informacion = array();
        $informacion['operacion'] = $operacion;
        $informacion['rol'] = $rol;
        return view('rol.formulario')->with($informacion);
    }

    function save(Request $r)
    {
        $datos = $r->all();
        switch ($datos['operacion']){
            case 'Agregar':
                $rol = new Rol();
                $rol->nomrol = $datos['nomrol'];
                $rol->save();
            break;
            
            case 'Editar':
                $rol = Rol::find($datos['idrol']);
                $rol->nomrol = $datos['nomrol'];
                $rol->save();
            break;

            case 'Eliminar':
                $rol = Rol::find($datos['idrol']);
                $rol->delete();
            break;
        }

        return redirect()->route('index_rol');
    }
}