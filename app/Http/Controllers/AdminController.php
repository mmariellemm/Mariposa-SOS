<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Usuario;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller{
    function home(){
        $datos=array();
        $datos['email']=Auth::user()->email;
        return view('admin.admin')->with($datos);
    }
}