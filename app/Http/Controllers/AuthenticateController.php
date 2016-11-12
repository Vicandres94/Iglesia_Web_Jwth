<?php

namespace App\Http\Controllers;


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

    

    public function authenticate(Request $request)
    {
        $UserBll = new UserBLL();
        return response()->json($UserBll->Authenticate($request->all()));
    }
    
    
}
