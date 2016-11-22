<?php
/**
 * Created by PhpStorm.
 * User: Equipo
 * Date: 21/11/2016
 * Time: 12:02 PM
 */

namespace App\BLL;


use App\Categoria;
use App\Entidades\Respuesta;

class CategoriaBLL
{
    public  function CrearCategoria($datos)
    {
        $respuesta = new Respuesta();
        $categoria = new Categoria();
        if (!empty($datos["categoria"])){
            $Categoria = Categoria::all();
            $cont=0;
            foreach ($Categoria as $item){
                if ($datos["categoria"] == $item->categoria){
                    $cont= $cont+1;
                }
            }
            if ($cont>=1){
                $respuesta->error = true;
                $respuesta->mensaje = "La Categoria ya Existe!";
            }
            else{
                $categoria->categoria = $datos['categoria'];
                if ($categoria->save()) {
                    $respuesta->datos = $categoria;
                    $respuesta->error = false;
                    $respuesta->mensaje = "Categoria almacenada Exitosamente";
                }
                else{
                    $respuesta->datos = null;
                    $respuesta->error = true;
                    $respuesta->mensaje = "Error al Registrar Categoria";
                }
            }
        }
        else{
            $respuesta->error = true;
            $respuesta->mensaje = "Verifique que los campos no estén vacios";
        }
        return $respuesta;
    }

    public function GetCategorias(){
        $respuesta = new Respuesta();
        $categorias = Categoria::all();
        if(count($categorias) != 0){
            $respuesta->error = false;
            $respuesta->datos = $categorias;
        }
        else{
            $respuesta->error = true;
            $respuesta->mensaje = "No se encuentran Categorias  registradas";
        }
        return $respuesta;
    }

    public function EliminarCategoria($datos){
        $respuesta = new Respuesta();
        if(!empty($datos["categoriasId"])){
            $categoria = Categoria::find($datos["categoriasId"]);
            if($categoria){
                if($categoria->delete()){
                    $respuesta->error = false;
                    $respuesta->mensaje = "Categoria eliminada exitosamente";
                }
                else{
                    $respuesta->error = true;
                    $respuesta->mensaje = "Error al eliminar Categoria, intente nuevamente";
                }
            }
            else{
                $respuesta->error = true;
                $respuesta->mensaje = "La Categoria que desea eliminar no existe";
            }
        }
        else{
            $respuesta->error = true;
            $respuesta->mensaje = "Verifique que los datos no estén vacios";
        }
        return $respuesta;
    }

    public  function ModificarCategoria($datos)
    {
        $respuesta = new Respuesta();
        if (!empty($datos["categoriasId"])){
            $Categoria = Categoria::all();
            $cont=0;
            foreach ($Categoria as $item){
                if (($datos["categoria"] == $item->categoria) && ($datos["categoriasId"] != $item->categoriasId)){
                    $cont= $cont+1;
                }
            }
            if ($cont>=1){
                $respuesta->error = true;
                $respuesta->mensaje = "La Categoria ya Existe!";
            }
            else{
                $categoria = Categoria::find($datos["categoriasId"]);
                if ($categoria){
                    if (!empty($datos["categoria"])){
                        $categoria->categoria = $datos['categoria'];                        
                        if ($categoria->save()) {
                            $respuesta->datos = $categoria;
                            $respuesta->error = false;
                            $respuesta->mensaje = "Categoria Modificada Exitosamente";
                        }
                        else{
                            $respuesta->datos = null;
                            $respuesta->error = true;
                            $respuesta->mensaje = "Error al Modificar Categoria";
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