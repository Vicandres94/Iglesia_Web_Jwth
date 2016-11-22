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
        if (!empty($datos["NombreRol"])){
            $Rol = Rol::all();
            $cont=0;
            foreach ($Rol as $item){
                if ($datos["nombreRol"] == $item->nombreRol){
                    $cont= $cont+1;
                }
            }
            if ($cont>=1){
                $respuesta->error = true;
                $respuesta->mensaje = "El Rol ya Existe!";
            }
            else{
                $rol->rol = $datos['nombreRol'];
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
        }
        else{
            $respuesta->error = true;
            $respuesta->mensaje = "Verifique que los campos no estén vacios";
        }
        return $respuesta;
    }

    public function GetRoles(){
        $respuesta = new Respuesta();
        $roles = Rol::all();
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

    public function EliminarRol($datos){
        $respuesta = new Respuesta();
        if(!empty($datos["rolesId"])){
            $rol = Rol::find($datos["rolesId"]);
            if($rol){
                if($rol->delete()){
                    $respuesta->error = false;
                    $respuesta->mensaje = "Rol eliminado exitosamente";
                }
                else{
                    $respuesta->error = true;
                    $respuesta->mensaje = "Error al eliminar Rol, intente nuevamente";
                }
            }
            else{
                $respuesta->error = true;
                $respuesta->mensaje = "El rol que desea eliminar no existe";
            }
        }
        else{
            $respuesta->error = true;
            $respuesta->mensaje = "Verifique que los datos no estén vacios";
        }
        return $respuesta;
    }

    public  function ModificarRol($datos)
    {
        $respuesta = new Respuesta();
        if (!empty($datos["rolesId"])){
            $Rol = Rol::all();
            $cont=0;
            foreach ($Rol as $item){
                if (($datos["nombreRol"] == $item->nombreRol)){
                    $cont= $cont+1;
                }
            }
            if ($cont>=1){
                $respuesta->error = true;
                $respuesta->mensaje = "El Producto ya Existe!";
            }
            else{
                $producto = Producto::find($datos["productosId"]);
                if ($producto){
                    if (!empty($datos["producto"]) && !empty($datos["valor"])){
                        $producto->producto = $datos['producto'];
                        $producto->valor = $datos['valor'];
                        if ($producto->save()) {
                            $respuesta->datos = $producto;
                            $respuesta->error = false;
                            $respuesta->mensaje = "Producto Modificado Exitosamente";
                        }
                        else{
                            $respuesta->datos = null;
                            $respuesta->error = true;
                            $respuesta->mensaje = "Error al Registrar Producto";
                        }
                    }
                    else{
                        $respuesta->datos = null;
                        $respuesta->error = true;
                        $respuesta->mensaje = "Verifique que los campos no estén vacios";
                    }
                }
                else{
                    $respuesta->datos = null;
                    $respuesta->error = true;
                    $respuesta->mensaje = "Verifique que los campos no estén vacios";
                }

            }
        }
        else{
            $respuesta->error = true;
            $respuesta->mensaje = "Verifique que los campos no estén vacios";
        }
        return $respuesta;
    }
}