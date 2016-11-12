<?php
/**
 * Created by PhpStorm.
 * User: Equipo
 * Date: 11/11/2016
 * Time: 10:32 PM
 */

namespace App\BLL;

use App\Iglesia;
use App\Entidades\Respuesta;

class IglesiaBLL
{
    public function GetIglesia($iglesiasId){
        $respuesta = new Respuesta();
        if(!empty($iglesiasId)){
            $iglesia = Iglesia::find($iglesiasId);
            if($iglesia){
                $respuesta->error = false;
                $respuesta->datos = $iglesia;
            }
            else{
                $respuesta->error = true;
                $respuesta->mensaje = "La iglesia no se encuentra registrada";
            }
        }
        else{
            $respuesta->error = true;
            $respuesta->mensaje = "Verifique que los campos no esten vacios";
        }
        return $respuesta;
    }
}