<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Usuario;
use App\Model\Jugador;
use App\Model\Skin;
use App\BusinessLogic\BoOrden;
use Faker\Factory as Faker;

class DbUpController extends Controller
{
    //var
    var $generos=array('M','F');
    var $edades=array('1','2','3');
    var $aliasf=array( 'Shadow','Luna','Frosty','Mystic','Dreamy','Phoenix','Stormy','Crimson','Echo','Blaze','Spark','Vortex','Nova','Zephyr','Nyx','Dusk','Sol','Veil','Ember','Breeze');
    var $canales=array('WEB','Unity','Android');

    
    //crear jugadores
    function crear_jugadores(){
        $faker = Faker::create();
        $password=bcrypt('12345');
       for($i=1;$i<5;$i++){
            //1. registro a mi usuario 
            $usuario=new Usuario();
            $usuario->email=$faker->email;
            $usuario->password=$password;
            $usuario->idrol=2;
            $usuario->save();

            //2. Registro a mi jugador
            $jugador=new Jugador();

            $nombre=$faker->name;
            $apellido=$faker->lastname;

            $jugador->nombre=$nombre.' '.$apellido;
            //$jugador->alias=$nombre.' '.$apellido;
            $jugador->score=0;
            //genero
            //limite fijo
            $indice_genero=$faker->numberBetween(0,1);
            $jugador->genero=$this->generos[$indice_genero];
            //edad
            $indice_edad=$faker->numberBetween(0,2);
            $jugador->edad=$this->edades[$indice_edad];
            //Alias 
            $indice_aliasf=$faker->numberBetween(0,18);
            $jugador->alias=$this->aliasf[$indice_aliasf];
            //el limite es variable 
            //$indice_edad=$faker->numberBetween(1,count($this->edades));
            //$jugador->edad=$indice_edad;
            $jugador->idusuario=$usuario->id;
            $jugador->save();
        }
    }
    //crear jugadores 
    //crear ordenes
    function crear_ordenes(){
        $faker = Faker::create();
        $bo=new BoOrden();
        //version eficiente hago una consultsa 1 vez 
        // y dentro del ciclo selecciono aleatoriamente 
        $armas=Skin::all();
        for($i=1;$i<5;$i++){
            $objeto=new \StdClass();
            //idusuario
            //version no eficiente hacer una consulta 
            //cada vez 
            $usuario=Usuario::where('idrol',2)
                            ->inRandomOrder()
                            ->limit(1)
                            ->first();
            
            $objeto->idusuario=$usuario->id;
            //canal 
            $objeto->canal=$faker->randomElement($this->canales);
            //fecha
            $objeto->fecha=$faker->dateTimeBetween($startDate ='-6 month' , $endDate = 'now');
            $numero_productos=$faker->numberBetween(1,2);
            $lista_armas=$armas->random($numero_productos);
            $objeto->productos=array();
            
            foreach($lista_armas as $elemento){
                $tmp=array();

                $tmp['idproducto']=$elemento->id_item;
                $tmp['id_item']=$elemento->id_item;
                $tmp['cantidad']=1;
                $tmp['precio']=$elemento->precio;
                $objeto->productos[]=$tmp;
            }
            $bo->crear_orden($objeto);
        }
    }

    
}
