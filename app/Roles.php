<?php
/**
 * Created by PhpStorm.
 * User: Equipo
 * Date: 9/11/2016
 * Time: 11:49 AM
 */

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;

class Roles extends Authenticatable
{
    protected $table = "Roles";
    protected  $fillable = ['rol'];

    public function User(){
        return $this->hasMany('App\User');
    }
}