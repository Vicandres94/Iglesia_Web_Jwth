<?php
/**
 * Created by PhpStorm.
 * User: Equipo
 * Date: 9/11/2016
 * Time: 12:03 AM
 */

namespace App\Entidades;


class RespuestaToken
{
    public $error;
    public $datos;
    public $mensaje;
    public $token;
    
    //Esa es la clase que vamos a retornar, te acuerdas que boris hacia los dto?  sis
    //bueno aca en laravel es más facil se hace uno o dos dto y quedan genericos para todo
    //porque php es un lenguaje debilmente tipado eso favorece en esta parte ahora hare la bll
}