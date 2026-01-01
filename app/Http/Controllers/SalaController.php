<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Model\Sala;
use Illuminate\Support\Facades\Storage;

class SalaController extends Controller
{
    function listado()
    {
        $datos =array();
        $datos['salas']=Sala::all();
        return view('sala.listado')->with($datos);
    }

    function formulario(Request $r,$id_sala = 0)
    {
        $datos =array();
        if ($id_sala==0) {
            // Voy a agregar, envío un jugador vacío
            $datos['operacion']='Agregar';
            $sala=new Sala();
            $sala->id_sala=0;
        }
        else {
            // Voy a modificar, envío un jugador con los datos del id
            $datos['operacion']='Modificar';
            $sala=Sala::find($id_sala);
        }

        $datos['sala']=$sala;
        return view('sala.formulario')->with($datos);
    }

    function operacion(Request $r)
    {
        // Recojo toda la información enviada en la petición
        $datos=$r->all();
        switch ($datos['operacion']) 
        {
            case 'Agregar':
                // Código para agregar el registro
                $x=new Sala();
                // Leo el valor del dato 'nombre' enviado en la petición
                $x->nombre=$datos['nombre'];
                // Guardo en la base de datos
                $x->save();
                
            break;

            case 'Modificar':
                // Código para modificar el registro
                $x = Sala::find($datos['id_sala']); //no tocar
                $x->nombre = $datos['nombre'];
                $x->save();
            break;

            case 'Eliminar':
                // Código para eliminar el registro
                $x = Sala::find($datos['id_sala']);  //no tocar
                $x->delete();
            break;
        }

        // Redirijo a la ruta llamada 'index_personaje'
        return redirect()->route('index_sala');
    }
}
