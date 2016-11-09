<?php

namespace App\Http\Controllers;

use App\BLL\RolesBLL;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use AppHttpRequests;
use AppHttpControllersController;
use App\BLL\UserBLL;


class AuthenticateController extends Controller
{
    public function __construct()//Creas un constructor y dentro el middlewere para que valide que tiene que recibir un token sino no ejecuta la api
    {
        $this->middleware('jwt.auth', ['except' => ['authenticate']]); //Exigira token en todas las api, menos en la de autenticacion, probemos
    }

    public function index()
    {
        $userBll = new UserBLL();
        return response()->json($userBll->GetUsuarios());
    }

    public function authenticate(Request $request)
    {
        $UserBll = new UserBLL();
        return response()->json($UserBll->Authenticate($request->all()));
    }
    
    public  function  GetRoles(){
        $rolesBLL = new RolesBLL();
        return response()->json($rolesBLL->GetRoles());
    }

    public function CreateRol(Request $request){
        $rolesBLL = new RolesBLL();
        return response()->json($rolesBLL->CreateRol($request->all()));
    }
}
