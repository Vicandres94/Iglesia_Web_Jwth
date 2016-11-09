<?php
/**
 * Created by PhpStorm.
 * User: Equipo
 * Date: 9/11/2016
 * Time: 12:06 AM
 */

namespace App\BLL;

//aqui utilizaré el token y utilizaré el modelo user
use JWTAuth;
use App\User;
use App\Entidades\RespuestaToken;
use Illuminate\Support\Facades\Hash;
use App\Entidades\Respuesta;

class UserBLL
{
    //Ahora lo pruebo en el controller
    public function Authenticate($datos){
        $respuesta = new RespuestaToken();
        if(!empty($datos["username"]) && !empty($datos["password"])){ //valido que los campos no vengan vacios
            //ahora en esta parte necesito hacer que me retorne el token y el usuario completo, entonces se hace esto asi lo hago yo
            //primero consulto al usuario
            $usuario = User::where('username', $datos["username"])->first();
            if($usuario){ //valido que el usuario exista
                if (Hash::check($datos['password'], $usuario->password)) { //valido que los password coincidan
                    $respuesta->error = false;
                    $respuesta->datos = $usuario;
                    $respuesta->mensaje = "token Exitoso";
                    $respuesta->token = JWTAuth::fromUser($usuario); //Genero el token para ese usuario
                }
                else{ //Si las contraseñas no coinciden entonces error
                    $respuesta->error = true;
                    $respuesta->mensaje = "Credenciales invalidas";
                }
            }
            else{
                $respuesta->error = true;
                $respuesta->mensaje = "Credenciales invalidas";
            }
        }
        else{
            $respuesta->error = true;
            $respuesta->mensaje = "Verifique que los campos no estén vacios";
        }
        return $respuesta;
    }
    
    public function GetUsuarios(){
        $respuesta = new Respuesta();
        $usuarios = User::all();
        if(count($usuarios) != 0){
            $respuesta->error = false;
            $respuesta->datos = $usuarios;
        }
        else{
            $respuesta->error = true;
            $respuesta->mensaje = "No se encuentran usuarios registrados";
        }
        return $respuesta;
    }
}