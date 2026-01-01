<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Model\Usuario;
use App\Model\Rol;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    function listado(){
        $datos=array();
        //Este metodo del modelo obtiene todos los datos de la tabla
        //Usuario
        //Listado sin join
        // $datos ['usuarios']=Usuario::all();

        //Listado con join

        $datos['usuarios']=Usuario::join('rol', 'rol.idrol', '=', 'usuario.idrol')->get();

        //usuario.listado significa que hay carpeta
        //llamada jugador y ahi hay un archivo que se llama listado
        //listado
        return view('usuario.listado')->with($datos);
    }

    function formulario($id=0){
        $datos=array();
        if($id==0){
            //Agregar
            $datos['operacion']='Agregar';
            $usuario=new Usuario();
            $usuario->id=0;
        }
        else{
            //Modificar
            $datos['operacion']='Modificar';
            //El metodo find sirve para recuperar informacion
            //del modelo por medio del id
            $usuario=Usuario::find($id);
        }

        $datos['usuario']=$usuario;
        $datos['roles']=Rol::all();
        return view ('usuario.formulario')->with($datos);
    }

    function operaciones(Request $r){
        $datos=$r->all();
        switch ($datos['operacion']){
            case 'Agregar':
                $j=new Usuario();
                $j->email=$datos['email'];
                $j->password=bcrypt($datos['password']);
                $j->idrol=$datos['idrol'];
                $j->save();
            break;
            case 'Modificar':
                $j=Usuario::find($datos['id']);
                $j->email=$datos['email'];
                $j->idrol=$datos['idrol'];
                if($datos['password']!='')
                    $j->password= bcrypt($datos['password']);
                $j->save();
            break;
            case 'Eliminar':
            $j=Usuario::find($datos['id']);
            $j->delete();
            break;
        }
        return redirect()->route('index_usuario');
    }
    public function mostrar_foto($nombre_foto){


        $path = storage_path('app/fotos/'.$nombre_foto);
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