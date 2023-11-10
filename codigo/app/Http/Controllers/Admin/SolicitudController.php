<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Solicitud, App\Models\Entrega, App\Models\Usuario, App\Models\Bitacora;
use Validator, Auth, Hash, Config, Carbon\Carbon;
use App\Imports\SolicitudImport;
use Maatwebsite\Excel\Facades\Excel;

class SolicitudController extends Controller
{
    public function getInicio(){
        $solicitudes = Solicitud::with(['entrega', 'usuario'])->get();

        $datos = [
            'solicitudes' => $solicitudes
        ];

        return view('admin.solicitudes.inicio',$datos);
    }

    public function getSolicitudRegistrar(){
        $entregas = Entrega::where('year', 2023)->get();

        $datos = [
            'entregas' => $entregas
        ];

        return view('admin.solicitudes.registrar',$datos);
    }

    public function postSolicitudInicio(Request $request){
        $s = new Solicitud;
        $s->id_entrega = $request->input('idEntrega');
        $s->id_usuario = $request->input('idUsuario');
        $s->observaciones = $request->input('observaciones');
        $s->save();

        $solicitud = Solicitud::findOrFail($s->id);

        $datos = [
            'solicitud' => $solicitud
        ];

        return view('admin.solicitudes.cargar_datos',$datos);

    }

    public function postSolicitudImportar(Request $request){
        $solicitud = Excel::toArray(new SolicitudImport, request()->file('datos_solicitud'));
        $id_solicitud = Solicitud::findOrFail($request->input('id_solicitud'));
        $entrega = Entrega::findOrFail($id_solicitud->id_entrega);

        $resultados;

        foreach($solicitud[0] as $s):
            $resultados[] = $s;
        endforeach;
       
        $datos = [
            'entrega' => $entrega,
            'resultados' => $resultados
        ]; 

        return view('admin.solicitudes.validar_import', $datos);
        
    }

    public function postSolicitudGuardarDatos(Request $request){
        return $request->all();

        return view('admin.solicitudes.validar_import', $datos);
        
    }
}
