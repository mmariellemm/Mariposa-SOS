<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Model\Skin;
use App\Model\Usuario;
use App\Model\Jugador;
use App\BusinessLogic\BoJugador;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TiendaController extends Controller
{

    function listado()
    {
        $datos =array();

        //Para ordenarlo por id se usa orderBy. En laravel se usa este metodo para ordenar los resultados
        // y 'asc' significa ascendente
        //get ejecuta la consulta y recupera los resultados que se almacenan en jugadores del arreglo datos

        //$datos['jugadores'] = Jugador::orderBy('id_jugador', 'asc')->get(); 

        $bo=new BoJugador();
        $datos=array();
        $idusuario=Auth::user()->id;
        $jugador=Jugador::where('idusuario',$idusuario)->first();
        $usuario=Usuario::where('id',$idusuario)->first();
        $datos['usuario']=$usuario;
        $datos['jugador']=$jugador;
        $datos['skins']=Skin::all();
        return view('tienda.listado')->with($datos);
    }
    

    
    public function mostrar_foto($nombre_foto){


        $path = storage_path('app/skins/'.$nombre_foto);
        if(!File::exists($path)){
            abort(404);
        }
        $file=File::get($path);

        $type=File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
}
