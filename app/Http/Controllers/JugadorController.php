<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Model\Jugador;
use App\Model\Usuario;
use App\Model\Personaje;
use App\Model\Danio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


use App\BusinessLogic\BoJugador;
use App\BusinessLogic\BoPartida;
use App\BusinessLogic\BoTurno;
use App\BusinessLogic\BoControlJuego;


class JugadorController extends Controller
{
    function listado()
    {
        $datos=array();

        //Para ordenarlo por id se usa orderBy. En laravel se usa este metodo para ordenar los resultados
        // y 'asc' significa ascendente
        //get ejecuta la consulta y recupera los resultados que se almacenan en jugadores del arreglo datos

        //$datos['jugadores'] = Jugador::orderBy('id_jugador', 'asc')->get(); 

        $datos['jugadores']=Jugador::all();
        return view('jugador.listado')->with($datos);
    }

    function formulario(Request $r,$id = 0)
    {
        $datos =array();
        if ($id==0) {
            // Voy a agregar, envío un jugador vacío
            $datos['operacion']='Agregar';
            $jugador=new Jugador();
            $jugador->id=0;
        }
        else {
            // Voy a modificar, envío un jugador con los datos del id
            $datos['operacion']='Modificar';
            $jugador=Jugador::find($id);
        }

        $datos['jugador']=$jugador;
        return view('jugador.formulario')->with($datos);
    }

    function operacion(Request $r)
    {
        // Recojo toda la información enviada en la petición
        $datos=$r->all();
        $archivo=$r->file('foto');
        switch ($datos['operacion']) {
            case 'Agregar':
                // Código para agregar el registro
                $x=new Jugador();
                // Leo el valor del dato 'nombre' enviado en la petición
                $x->nombre=$datos['nombre'];
                $x->alias=$datos['alias'];
                $x->foto='';
                // Guardo en la base de datos
                $x->save();

                if($r->hasfile('foto')){
                    $nombre_archivo='foto-'.$x->id.'.'.$archivo->getClientOriginalExtension();
                    $archivo_subido=$archivo->storeAs('fotos',$nombre_archivo);
                    $x->foto=$nombre_archivo;
                    $x->save();
                }
            break;

            case 'Modificar':
                // Código para modificar el registro
                $x = Jugador::find($datos['id']); //no tocar
                $x->nombre = $datos['nombre'];
                $x->alias = $datos['alias'];
                if($r->hasFile('foto')){
                    if($x->foto!=''){
                        Storage::delete('fotos/'.$x->foto);
                    }
                    $nombre_archivo='foto-'.$x->id.'.'.$archivo->getClientOriginalExtension();


                    $archivo_subido=$archivo->storeAs('fotos',$nombre_archivo);
                    $x->foto=$nombre_archivo;
                }
                $x->save();
            break;

            case 'Eliminar':
                // Código para eliminar el registro
                $x = Jugador::find($datos['id']);  //no tocar
                if($x->foto!=''){
                    Storage::delete('fotos/'.$x->foto);
                }
                $x->delete();
            break;
        }

        // Redirijo a la ruta llamada 'index_personaje'
        return redirect()->route('index_jugador');
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

    function formulario_autoregistro(){
        $datos=array();
        return view('jugador.autoregistro')->with($datos);
    }



    function autoregistro(Request $r)
    {
        $datos=$r->all();
        $archivo=$r->file('foto');

        //1. registro a mi usuario 
        $usuario=new Usuario();
        $usuario->email=$datos['email'];
        $usuario->password=bcrypt($datos['password']);

        $usuario->idrol=2;
        $usuario->save();


        //2. registro a mi jugador 
        $jugador=new Jugador();
        $jugador->nombre=$datos['nombre'];
        $jugador->alias=$datos['alias'];
        $jugador->genero=$datos['genero'];
        $jugador->edad=$datos['edad'];
        $jugador->foto='';
        $jugador->idusuario=$usuario->id;
        $jugador->save();
        //El usuario tiene foto debido al panel de unity
        if($r->hasfile('foto')){$nombre_archivo='foto-'.$jugador->id.'.'.$archivo->getClientOriginalExtension();
                    $archivo_subido=$archivo->storeAs('fotos',$nombre_archivo);
                    $jugador->foto=$nombre_archivo;
                    $jugador->save();
        }

        
        return view ('landing.page');
    }

    function home(){
        $bo=new BoJugador();
        $datos=array();
        $idusuario=Auth::user()->id;
        $jugador=Jugador::where('idusuario',$idusuario)->first();
        $datos['jugador']=$jugador;
        $datos['partidas']=$bo->dame_partidas_jugador($jugador->id);
        $datos['tesoros']=$bo->damete($jugador->id);
        $datos['skins']=$bo->dameskin($jugador->id);
        $datos['puntos']=$bo->obtener_total_puntos_1($jugador->id);
        return view('jugador.home')->with($datos);
    }
    
    function home2(){
        $bo=new BoJugador();
        $datos=array();
        $idusuario=Auth::user()->id;
        $jugador=Jugador::where('idusuario',$idusuario)->first();
        $usuario=Usuario::where('id',$idusuario)->first();
        $datos['usuario']=$usuario;        
        $datos['jugador']=$jugador;
        $datos['skins']=$bo->dameskin($jugador->id);
        return view('jugador.perfil')->with($datos);
    }

    function crear_sala(){
        $datos=array();
        $datos['personajes']=Personaje::all();
        return view('jugador.crear_sala')->with($datos);
    }

    function guardar_partida(Request $request){
        $context=$request->all();
        $objeto=new \StdClass();
        $objeto->nombre=$context['nombre'];
        $objeto->codigo=$context['codigo'];
        $objeto->idpersonaje=$context['idpersonaje'];

        $idusuario=Auth::user()->id;
        $jugador=Jugador::where('idusuario',$idusuario)->first();
        $objeto->idjugador=$jugador->id;

        $bopartida=new BoPartida();
        $bopartida->crear_partida($objeto);

    }

    function unir_partida(){
        $datos=array();
        $datos['personajes']=Personaje::all();
        return view('jugador.unir_partida')->with($datos);
    }

    function unir_partida_save(Request $request){
        $context=$request->all();
        $objeto=new \stdClass();
        $jugador=dame_jugador();
        $objeto->idjugador=$jugador->id;
        $objeto->codigo=$context['codigo'];
        $objeto->idpersonaje=$context['idpersonaje'];

        $bopartida=new BoPartida();
        $resultado=$bopartida->unir_partida($objeto);
        if($resultado->status=='OK'){
            //Si pude inscribir a mi usuario en la partida
        }
        else{
            return view('jugador.mensaje')->with('mensaje', $resultado->mensaje);
            //dd($resultado->mensaje);
        }
    }
    function iniciar_partida($id){
        $bopartida=new BoPartida();
        $bopartida->iniciar_partida($id);
    }

    function unir_partida_turno($id){
        $bopartida=new BoPartida();
        $boturno=new BoTurno();
        $bocontrol=new BoControlJuego();
        $objeto=new \stdClass();
        $jugador=dame_jugador();
        $objeto->idpartida=$id;
        $objeto->idjugador=$jugador->id;
            $resultado=$bopartida->valida_turno_jugador($objeto);
            if($resultado->status=='OK'){
                //Si es tu turno tenemos que preguntar si el turno esta abierto o no
                $info=$boturno->valida_turno_activo($resultado->detallepartida->id);
                if($info){
                    //Llevamos al usuario a una pagina para que reanude el turno
                    $datos=array();
                    //1.-Obtener el jugador y personaje del turno
                    //2.-Obtener el monstruo con el que esta peleando
                    $datos['turno']=$info;
                    //3.-El objetivo para matar al monstruo
                    $objeto2=new \stdClass();
                    $objeto2->idmonstruo=$info->idmonstruo;
                    $objeto2->idpersonaje=$info->idpersonaje;
                    $datos['danio']=$bocontrol->dame_danio($objeto2);
                    return view('turno.tirar_dados')->with($datos);
                }
                else{
                    //No existe un turno activo entonces lo llevamos a la pagina
                    //Para que seleccione el nivel y posteriormente cree el turno
                    $datos=array();
                    $datos['iddetallepartida']=$resultado->detallepartida->id;
                    return view('turno.escoger_nivel')->with($datos);
                }
            }
            else{
                //Si no es tu turno lo vamos a llevar a una vista que se llama sala de espera
                $datos=array();
                $datos['jugador_actual']=$bopartida->obtener_jugador_actual($id);
                return view('turno.sala_espera')->with($datos);
            }
    }

    function crear_turno(Request $request){
        $context=$request->all();
        $objeto=new \stdClass();
        $objeto->nivel=$context['idnivel'];
        $objeto->iddetalle_partida=$context['iddetallepartida'];
        $boturno=new BoTurno();
        $boturno->crear_turno($objeto);
    }
    
    function tirar_dados(Request $request){
        $context=$request->all();
        $objeto=new \stdClass();
        $objeto->danio=$context['danio'];
        $objeto->iddetalle_partida=$context['iddetallepartida'];
        $objeto->idturno=$context['idturno'];
        $objeto->nivel=$context['nivel'];
        $boturno=new BoTurno();
        $bocontrol=new BoControlJuego();
            $resultado=$boturno->ataque_heroe($objeto);
            if($resultado->status=='OK'){
                $resultado2=$bocontrol->cerrar_partida($context['iddetallepartida']);
                if($resultado2->status=='OK'){
                    $datos=array();
                    $datos['resultado']=$resultado2;
                    return view('turno.ganaste')->with($datos);
                }
                else{
                    $datos=array();
                    $datos['tesoro']=$resultado->tesoro;
                    return view('turno.gano_heroe')->with($datos);
                }
            }
            else{
                $objeto=new \stdClass();
                $objeto->iddetalle_partida=$context['iddetallepartida'];
                $objeto->idturno=$context['idturno'];
                $objeto->idpartida=$context['idpartida'];
                $resultado=$boturno->ataque_monstruo($objeto);
                $mensaje= $resultado->mensaje;
                $datos=array();
                $datos['mensaje']=$mensaje;
                return view('turno.gano_monstruo')->with($datos);
                //dd($resultado);
            }
    }


}
