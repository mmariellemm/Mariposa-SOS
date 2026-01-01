<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\BusinessLogic\BoDashboard;

class DashboardController extends Controller{
function index(){
    $datos=array();
    $datos['anios']=array();
    $anio_actual=date('Y');
    for($i=$anio_actual;$i>=2010;$i--){
        $datos['anios'][]=$i;
    }
    $datos['anio_actual']=$anio_actual;
   
    return view('dashboard.index')->with($datos);
}

function dame_ventas_mes(Request $r){
    $contexto=$r->all();
    $bo=new BoDashboard();
    $objeto=new \StdClass();
    $objeto->fecha=$contexto['anio'];
    if(isset($contexto['canal']))
    $objeto->canal=$contexto['canal'];
else
$objeto->canal='';
return response()->json($bo->dame_ventas_productos_mes($objeto));

}


function dame_ventas_canal(Request $r){
    $contexto=$r->all();
    $bo=new BoDashboard();
    $objeto=new \StdClass();
    $objeto->fecha=$contexto['anio'];
    if(isset($contexto['canal']))
    $objeto->canal=$contexto['canal'];
    else
    $objeto->canal='';
    return response()->json($bo->dame_ventas_productos_canal($objeto));

}

/* ESTA ES LA DE GENERO*/
function dame_total_genero(Request $r){
    $bo = new BoDashboard();
    $objeto = new \StdClass();

    $context = $r->all(); // Aquí he añadido la variable $context para obtener los datos del request.

    if(isset($context['edad'])){
        $objeto->edad = $context['edad'];
    }else{
        $objeto->edad = '';
    }

    if(isset($context['genero'])){
        $objeto->genero = $context['genero'];
    }else{
        $objeto->genero = '';
    }

    return response()->json($bo->dame_total_genero($objeto)); //Este es el filtro por edad que esta en el BoDashboard
}


/* ESTA ES DE EDAD*/
function dame_total_edad(Request $r){
    $bo=new BoDashboard();
    $objeto=new \StdClass();

    $context = $r->all(); // Aquí he añadido la variable $context para obtener los datos del request.

    if(isset($context['edad'])){
        $objeto->edad = $context['edad'];
    }else{
        $objeto->edad = '';
    }

    if(isset($context['genero'])){
        $objeto->genero = $context['genero'];
    }else{
        $objeto->genero = '';
    }

    return response()->json($bo->dame_total_edad($objeto));//Este es el filtro por genero que esta en el BoDashboard
}
}