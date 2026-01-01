<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Model\Skin;
use Illuminate\Support\Facades\Storage;

class SkinController extends Controller
{
    function listado()
    {
        $datos =array();

        //Para ordenarlo por id se usa orderBy. En laravel se usa este metodo para ordenar los resultados
        // y 'asc' significa ascendente
        //get ejecuta la consulta y recupera los resultados que se almacenan en jugadores del arreglo datos

        //$datos['jugadores'] = Jugador::orderBy('id_jugador', 'asc')->get(); 

        $datos['skins']=Skin::all();
        return view('skin.listado')->with($datos);
    }

    function formulario(Request $r,$id = 0)
    {
        $datos =array();
        if ($id==0) {
            // Voy a agregar, envío un jugador vacío
            $datos['operacion']='Agregar';
            $skin=new Skin();
            $skin->id=0;
            $skin->puntaje=0;
        }
        else {
            // Voy a modificar, envío un jugador con los datos del id
            $datos['operacion']='Modificar';
            $skin=Skin::find($id);
        }

        $datos['skin']=$skin;
        return view('skin.formulario')->with($datos);
    }

    function operacion(Request $r)
    {
        // Recojo toda la información enviada en la petición
        $datos=$r->all();
        $archivo=$r->file('foto');
        switch ($datos['operacion']) {
            case 'Agregar':
                // Código para agregar el registro
                $x=new Skin();
                // Leo el valor del dato 'nombre' enviado en la petición
                $x->nombre=$datos['nombre'];
                $x->foto='';
                $x->precio=$datos['precio'];
                // Guardo en la base de datos
                $x->save();

                if($r->hasfile('foto')){
                    $nombre_archivo='skin-'.$x->id.'.'.$archivo->getClientOriginalExtension();
                    $archivo_subido=$archivo->storeAs('skins',$nombre_archivo);
                    $x->foto=$nombre_archivo;
                    $x->save();
                }
            break;

            case 'Modificar':
                // Código para modificar el registro
                $x = Skin::find($datos['id']); //no tocar
                $x->nombre = $datos['nombre'];
                $x->skin = $datos['skin'];
                if($r->hasFile('foto')){
                    if($x->foto!=''){
                        Storage::delete('skins/'.$x->foto);
                    }
                    $nombre_archivo='skin-'.$x->id.'.'.$archivo->getClientOriginalExtension();


                    $archivo_subido=$archivo->storeAs('skins',$nombre_archivo);
                    $x->foto=$nombre_archivo;
                }
                $x->save();
            break;

            case 'Eliminar':
                // Código para eliminar el registro
                $x = Skin::find($datos['id']);  //no tocar
                if($x->foto!=''){
                    Storage::delete('skins/'.$x->foto);
                }
                $x->delete();
            break;
        }

        // Redirijo a la ruta llamada 'index_personaje'
        return redirect()->route('index_skin');
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
