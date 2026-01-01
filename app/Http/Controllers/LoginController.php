<?php
namespace App\Http\Controllers;

use App\Model\Usuario;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    function login(){
        return view('login');
    }
    function redirectPath()
    {
        //Este metodo sirve para indicarle al sistema
        //Cual es la pagina de inicio dependiendo del rol
        switch($this->guard()->user()->idrol){
            case 1:
                //El usuario es admin
                return 'home/admin';
            break;
            default:
                return 'perfil/jugador';
            break;
            //case 2:
                //El usuario es maestro
                //return 'page/landing'; 
                //return 'home/jugador';
            //break;
        }
    }
    function iniciar_sesion(Request $r){
        $context=$r->all();
        //dd($context); Sirve para imprimir los datos del login
        if(Auth::attempt(["email"=>$context['email'], "password"=>$context['password']])){
            //En esta linea lo que se hace es llamar un metodo que se llama
            //$this->redirectPath y va tener la funcion de llevar al usuario
            //A una pagina dependiendo de que tipo de usuario es


            //return $this->authenticated($r, $this->guard()->user())
              //  ?: redirect()->intended($this->redirectPath());
            

              $this->authenticated($r, $this->guard()->user());
                Session::flash('success','Has iniciado sesion correctamente');
                return redirect()->intended($this->redirectPath());

        }
        else{
            Session::flash('error', 'Algo salio mal, revisa los datos ingresados');
            return redirect()->route('login')->withInput();

            //return view('login');
        }
    }

    




    function logout(){
        Session::flush();
        return redirect()->route('login');
    }
}