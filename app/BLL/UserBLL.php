<?php
/**
 * Created by PhpStorm.
 * User: Equipo
 * Date: 9/11/2016
 * Time: 12:06 AM
 */

namespace App\BLL;

//aqui utilizaré el token y utilizaré el modelo user
use App\Iglesia;
use JWTAuth;
use App\User;
use App\Entidades\RespuestaToken;
use Illuminate\Support\Facades\Hash;
use App\Entidades\Respuesta;
use App\BLL\IglesiaBLL;
use App\BLL\RolBLL;

class UserBLL
{
    
    //Ahora lo pruebo en el controller
    public function Authenticate($datos){
        $respuesta = new RespuestaToken();
        if(!empty($datos["username"]) && !empty($datos["password"])){
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

    public function CrearUsuario($datos){
        $respuesta = new RespuestaToken();

        if(!empty($datos["nombres"]) && !empty($datos["apellidos"]) && !empty($datos["username"]) && !empty($datos["password"]) && !empty($datos["identificacion"]) && !empty($datos["telefono"]) && !empty($datos["direccion"]) && !empty($datos["rolesId"]) && !empty($datos["iglesiasId"])){
            $rolBll = new RolBLL();
            $rol = $rolBll->GetRol($datos["rolesId"]);
            if($rol->error == false){
                $iglesiaBll = new IglesiaBLL();
                $iglesia = $iglesiaBll->GetIglesia($datos["iglesiasId"]);
                if($iglesia->error == false){
                    $user = new User();
                    $user->nombres = $datos["nombres"];
                    $user->apellidos = $datos["apellidos"];
                    $user->username = $datos["username"];
                    $user->password = Hash::make($datos["password"]);
                    $user->identificacion = $datos["identificacion"];
                    $user->telefono = $datos["telefono"];
                    $user->direccion = $datos["direccion"];
                    $user->rolesId = $datos["rolesId"];
                    $user->iglesiasId = $datos["iglesiasId"];
                    if($user->save()){
                        $respuesta->error = false;
                        $respuesta->mensaje = "Datos almacenados exitosamente";
                        $respuesta->datos = $user;
                        $respuesta->token = JWTAuth::fromUser($user);
                    }
                    else{
                        $respuesta->error = true;
                        $respuesta->mensaje = "No se pudieron almacenar los datos, intente nuevamente";
                    }
                }
                else{
                    $respuesta->error = $iglesia->error;
                    $respuesta->mensaje = $iglesia->mensaje;
                }
            }
            else{
                $respuesta->error = $rol->error;
                $respuesta->mensaje = $rol->mensaje;
            }
        }
        else{
            $respuesta->error = true;
            $respuesta->mensaje = "Verifique que los campos no esten vacios";
        }
        return $respuesta;
    }
    
    
}