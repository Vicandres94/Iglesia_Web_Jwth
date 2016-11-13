<?php
/**
 * Created by PhpStorm.
 * User: Equipo
 * Date: 12/11/2016
 * Time: 10:02 PM
 */

namespace App\BLL;


use App\Entidades\Respuesta;
use App\Producto;

class ProductoBLL
{
    public  function CrearProducto($datos)
    {
        $respuesta = new Respuesta();
        $producto = new Producto();

        if (!empty($datos["producto"]) && !empty($datos["valor"])){
            $Producto = Producto::all();
            $cont=0;
            foreach ($Producto as $item){
                if ($datos["producto"] == $item->producto){
                    $cont= $cont+1;
                }
            }
            if ($cont>=1){
                $respuesta->error = true;
                $respuesta->mensaje = "El Producto ya Existe!";
            }
            else{
                $producto->producto = $datos['producto'];
                $producto->valor = $datos['valor'];
                if ($producto->save()) {
                    $respuesta->datos = $producto;
                    $respuesta->error = false;
                    $respuesta->mensaje = "Producto almacenado Exitosamente";
                }
                else{
                    $respuesta->datos = null;
                    $respuesta->error = true;
                    $respuesta->mensaje = "Error al Registrar Producto";
                }
            }
        }
        else{
            $respuesta->error = true;
            $respuesta->mensaje = "Verifique que los campos no estén vacios";
        }
        return $respuesta;
    }

    public function GetProductos(){
        $respuesta = new Respuesta();
        $productos = Producto::all();
        if(count($productos) != 0){
            $respuesta->error = false;
            $respuesta->datos = $productos;
        }
        else{
            $respuesta->error = true;
            $respuesta->mensaje = "No se encuentran Productos registrados";
        }
        return $respuesta;
    }

}