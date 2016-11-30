<?php

namespace App\Http\Controllers;

use App\BLL\ActividadBLL;
use Illuminate\Http\Request;

use App\Http\Requests;

class ActividadController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function CrearActividad(Request $request){
        $productoBll = new ActividadBLL();
        return response()->json($productoBll->CrearActividad($request->all()));
    }

    public function GetActividades(Request $request){
        $productoBll = new ActividadBLL();
        return response()->json($productoBll->GetActividades($request->all()));
    }

    public function ModificarActividad(Request $request){
        $productoBll = new ActividadBLL();
        return response()->json($productoBll->ModificarActividad($request->all()));
    }

    public function EliminarActividad(Request $request){
        $productoBll = new ActividadBLL();
        return response()->json($productoBll->EliminarActividad($request->all()));
    }
}
