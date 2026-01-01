<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Model\Personaje;
use Illuminate\Support\Facades\Storage;

class PersonajeController extends Controller
{
    
    function listado()
    {
        $datos =array();
        $datos['personajes']=Personaje::all();
        return view('personaje.listado')->with($datos);
    }

    function formulario(Request $r,$id = 0)
    {
        $datos =array();
        if ($id==0) {
            // Voy a agregar, envío un jugador vacío
            $datos['operacion']='Agregar';
            $personaje=new Personaje();
            $personaje->id=0;
        }
        else {
            // Voy a modificar, envío un jugador con los datos del id
            $datos['operacion']='Modificar';
            $personaje=Personaje::find($id);
        }

        $datos['personaje']=$personaje;
        return view('personaje.formulario')->with($datos);
    }

    function operacion(Request $r)
    {
        // Recojo toda la información enviada en la petición
        $datos=$r->all();
        $archivo=$r->file('imagen');
        switch ($datos['operacion']) {
            case 'Agregar':
                // Código para agregar el registro
                $x=new Personaje();
                // Leo el valor del dato 'nombre' enviado en la petición
                $x->nombre=$datos['nombre'];
                $x->objetivo=$datos['objetivo'];
                $x->imagen='';
                // Guardo en la base de datos
                $x->save();

                if($r->hasfile('imagen')){
                    $nombre_archivo='personaje-'.$x->id.'.'.$archivo->getClientOriginalExtension();
                    $archivo_subido=$archivo->storeAs('personajes',$nombre_archivo);
                    $x->imagen=$nombre_archivo;
                    $x->save();
                }
                $x->objetivo=$datos['objetivo'];
            break;

            case 'Modificar':
                // Código para modificar el registro
                $x = Personaje::find($datos['id']);
                $x->nombre = $datos['nombre'];
                if($r->hasFile('imagen')){
                    if($x->imagen!=''){
                        Storage::delete('personajes/'.$x->imagen);
                    }
                    $nombre_archivo='personaje-'.$x->id.'.'.$archivo->getClientOriginalExtension();


                    $archivo_subido=$archivo->storeAs('personajes',$nombre_archivo);
                    $x->imagen=$nombre_archivo;
                }
                $x->objetivo=$datos['objetivo'];
                $x->save();
            break;

            case 'Eliminar':
                // Código para eliminar el registro
                $x = Personaje::find($datos['id']);
                if($x->imagen!=''){
                    Storage::delete('personajes/'.$x->imagen);
                }
                $x->objetivo=$datos['objetivo'];
                $x->delete();
                
            break;
        }

        // Redirijo a la ruta llamada 'index_personaje'
        return redirect()->route('index_personaje');
    }
    public function mostrar_imagen($nombre_imagen){


        $path = storage_path('app/personajes/'.$nombre_imagen);
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
