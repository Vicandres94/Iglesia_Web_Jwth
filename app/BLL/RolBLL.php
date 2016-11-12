<?php
/**
 * Created by PhpStorm.
 * User: Equipo
 * Date: 11/11/2016
 * Time: 10:29 PM
 */

namespace App\BLL;
use App\Rol;
use App\Entidades\Respuesta;

class RolBLL
{
    public function GetRol($rolesId){
        $respuesta = new Respuesta();
        if(!empty($rolesId)){ //verifico que no este vacio
            $rol = Rol::find($rolesId);
            if($rol){
                $respuesta->error = false;
                $respuesta->datos = $rol;
            }
            else{
                $respuesta->error = true;
                $respuesta->mensaje = "El rol no se encuentra registrado";
            }
        }
        else{
            $respuesta->error = true;
            $respuesta->mensaje = "Verifique que los campos no esten vacios";
        }
        return $respuesta;
    }

    public  function CreateRol($datos)
    {
        $respuesta = new Respuesta();
        $rol = new Rol();
        $rol->nombreRol = $datos['nombreRol'];
        if (!empty($datos["nombreRol"])){
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
        return $respuesta;
    }
}