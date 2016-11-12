<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes; //debes hacer esto en todas los modelos

class User extends Authenticatable
{
    use SoftDeletes;
    protected $table = "users";
    protected $primaryKey = 'usersId';
    public $timestamps = false;
    protected $dates = ['deleted_at'];
}
