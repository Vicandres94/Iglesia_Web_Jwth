<?php
/**
 * Created by PhpStorm.
 * User: Equipo
 * Date: 12/11/2016
 * Time: 10:02 PM
 */

namespace App\BLL;


use App\Actividad;
use App\Categoria;
use App\Entidades\Respuesta;
use Carbon\Carbon;

class ActividadBLL
{
    public  function CrearActividad($datos)
    {
        $respuesta = new Respuesta();
        $actividad = new Actividad();
        $categoria =  Categoria::find($datos["categoriasId"]);

        if ($categoria){
            if (!empty($datos["fecha"]) && !empty($datos["estado"])){
                $Actividad = Actividad::all();
                $cont=0;
                foreach ($Actividad as $item){
                    if ($datos["categoriasId"] == $item->categoriasId && $datos["fecha"] == $item->fecha){
                        $cont= $cont+1;
                    }
                }
                if ($cont>=1){
                    $respuesta->error = true;
                    $respuesta->mensaje = "Ya Existe una Actividad del Mismo Tipo en Curso..";
                }
                else{
                    $fechaCarbon = Carbon::now();
                    $fechaCarbon->format('Y-m-d');
                    $fechaCarbon = $datos['fecha'];
                    $actividad->fecha = $fechaCarbon;
                    $actividad->estado = $datos['estado'];
                    $actividad->categoriasId = $datos["categoriasId"];
                    $actividad->iglesiasId = $datos["iglesiasId"];
                    if ($actividad->save()) {
                        $respuesta->datos = $actividad;
                        $respuesta->error = false;
                        $respuesta->mensaje = "Actividad almacenada Exitosamente";
                    }
                    else{
                        $respuesta->datos = null;
                        $respuesta->error = true;
                        $respuesta->mensaje = "Error al Registrar Actividad";
                    }
                }
            }
            else{
                $respuesta->error = true;
                $respuesta->mensaje = "Verifique que los campos no estén vacios";
            }
        }
        else{
            $respuesta->error = true;
            $respuesta->mensaje = "La Categoria Asociada a la  Actividad No Existe";
        }

        return $respuesta;
    }

    public function GetActividades(){
        $respuesta = new Respuesta();
        $actividades = Actividad::where('estado', "Pendiente")->get();
        if(count($actividades) != 0){
            $respuesta->error = false;
            $respuesta->datos = $actividades;
        }
        else{
            $respuesta->error = true;
            $respuesta->mensaje = "No se encuentran Actividades registradas";
        }
        return $respuesta;
    }

    public function EliminarActividad($datos){
        $respuesta = new Respuesta();
        if(!empty($datos["actividadesId"])){
            $producto = Actividad::find($datos["actividadesId"]);
            if($producto){
                if($producto->delete()){
                    $respuesta->error = false;
                    $respuesta->mensaje = "Actividad eliminado exitosamente";
                }
                else{
                    $respuesta->error = true;
                    $respuesta->mensaje = "Error al eliminar Actividad, intente nuevamente";
                }
            }
            else{
                $respuesta->error = true;
                $respuesta->mensaje = "La Actividad que desea eliminar no existe";
            }
        }
        else{
            $respuesta->error = true;
            $respuesta->mensaje = "Verifique que los datos no estén vacios";
        }
        return $respuesta;
    }

    public  function ModificarActividad($datos)
    {
        $respuesta = new Respuesta();
        if (!empty($datos["actividadesId"])){
            $Actividad = Actividad::all();
            $cont=0;
            foreach ($Actividad as $item){
                if ($datos["categoriasId"] == $item->categoriasId && $datos["fecha"] == $item->fecha){
                    $cont= $cont+1;
                }
            }
            if ($cont>=1){
                $respuesta->error = true;
                $respuesta->mensaje = "Ya Existe una Actividad del Mismo Tipo en Curso..";
            }
            else{
                $actividad= Actividad::find($datos["actividadesId"]);
                if ($actividad){
                    if (!empty($datos["fecha"]) && !empty($datos["estado"])){
                        $fechaCarbon = Carbon::now();
                        $fechaCarbon->format('Y-m-d');
                        $fechaCarbon = $datos['fecha'];
                        $actividad->fecha = $fechaCarbon;
                        $actividad->estado = $datos['estado'];
                        $actividad->categoriasId = $datos["categoriasId"];
                        $actividad->iglesiasId = $datos["iglesiasId"];
                        $actividad->inversion = $datos["inversion"];
                        if ($actividad->save()) {
                            $respuesta->datos = $actividad;
                            $respuesta->error = false;
                            $respuesta->mensaje = "Actividad Modificada Exitosamente";
                        }
                        else{
                            $respuesta->datos = null;
                            $respuesta->error = true;
                            $respuesta->mensaje = "Error al Actualizar Actividad";
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