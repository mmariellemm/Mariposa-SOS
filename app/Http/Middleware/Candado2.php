<?php
namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Model\Permiso;
use App\Model\RolxPermiso;

use Closure;
class Candado2
{

    public function handle($request, Closure $next,$clave)
    {
		/* 
		select * 
		from usuario 
		join rol on rol.idrol=usuario.idrol
		join rolxpermiso on rolxpermiso.idrol=rol.idrol
		join permiso on permiso.idpermiso=rolxpermiso.idpermiso
		where usuario.idusuario=2
		and permiso.cvepermiso='PERS'
		*/
    	$permiso=DB::table('usuario')
			->join('rol','rol.idrol','=','usuario.idrol')
			->join('rolxpermiso','rol.idrol','=','rolxpermiso.idrol')
			->join('permiso','rolxpermiso.idpermiso','=','permiso.idpermiso')
			->where('usuario.id',Auth::user()->id)
			->where('permiso.cvepermiso',$clave)
			->get();
		if(count($permiso)!=0){
			//El usuario si tiene permiso 
			return $next($request);
		}
		else{
			return redirect('/sinpermiso');
		}

    }
}