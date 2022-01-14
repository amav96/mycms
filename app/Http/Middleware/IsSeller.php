<?php

namespace App\Http\Middleware;

use Closure, Auth;
use App\Http\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;


class IsSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       
            if(Auth::user()){

              if(Auth::user()->status !== 'activo'){
                  return response()->json(['error' => 'Usuario inactivo'], 200); 
            }else if(Auth::user()->role !== 'vendedor' && Auth::user()->role !== 'administrador'){
                  return response()->json(['error' => 'El usuario no tiene permisos'], 200); 
            }else{

              return $next($request);
            }
          }else{
            return response()->json(['error' => 'No se reconoce el usuario'], 200); 
          }
          

    
    }
}