<?php
/**
 * Created by PhpStorm.
 * User: Equipo
 * Date: 9/11/2016
 * Time: 3:25 PM
 */

namespace App\BLL;


use App\Roles;
use JWTAuth;
use App\User;
use App\Entidades\RespuestaToken;
use Illuminate\Support\Facades\Hash;
use App\Entidades\Respuesta;

class RolesBLL
{
   public  function CreateRol($datos)
   {
       $respuesta = new Respuesta();
       $rol = new Roles();
       $rol->rol = $datos['rol'];
       if (!empty($datos["rol"])){
           if ($rol->save()) {
               $respuesta->datos = $rol;
               $respuesta->error = false;
               $respuesta->mensaje = "Rol almacenado Exitosamente";
           }
           else{
               $respuesta->datos = null;
               $respuesta->error = true;
               $respuesta->mensaje = "Error al Registrar Rol";
           }
       }
       else{
           $respuesta->error = true;
           $respuesta->mensaje = "Verifique que los campos no estén vacios";
       }

   }
    public function GetRoles(){
        $respuesta = new Respuesta();
        $roles = Roles::all();
        if(count($roles) != 0){
            $respuesta->error = false;
            $respuesta->datos = $roles;
        }
        else{
            $respuesta->error = true;
            $respuesta->mensaje = "No se encuentran roles registrados";
        }
        return $respuesta;
    }
}