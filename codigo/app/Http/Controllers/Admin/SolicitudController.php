<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Solicitud, App\Models\Bitacora;
use Validator, Auth, Hash, Config, Carbon\Carbon;
use App\Imports\SolicitudImport;
use Maatwebsite\Excel\Facades\Excel;

class SolicitudController extends Controller
{
    public function getInicio(){


        $datos = [

        ];

        return view('admin.solicitudes.inicio',$datos);
    }

    public function postSolicitudImportar(Request $request){
        $prueba = Excel::toArray(new SolicitudImport, request()->file('solicitudes'));
        return $prueba;
        $resultados;

        foreach($prueba[0] as $p):
            $resultados[] = $p;
        endforeach;
       
        $datos = [
            'resultados' => $resultados
        ]; 

        return view('admin.solicitudes.validar_import', $datos);
        
    }
}
