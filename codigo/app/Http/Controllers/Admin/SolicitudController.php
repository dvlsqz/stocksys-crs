<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Solicitud, App\Models\SolicitudDetalles,App\Models\Escuela, App\Models\Entrega, App\Models\Racion, App\Models\Usuario, App\Models\Bitacora;
use Validator, Auth, Hash, Config, Carbon\Carbon;
use App\Imports\SolicitudDetallesImport;
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

    public function postSolicitudRegistrar(Request $request){
        $s = new Solicitud;
        $s->id_entrega = $request->input('idEntrega');
        $s->id_usuario = $request->input('idUsuario');
        $s->observaciones = $request->input('observaciones');
        $s->save();

        $idSolicitud = $s->id;


        $solicitud = Excel::toArray(new SolicitudDetallesImport, request()->file('datos'));

        /*$resultados;

        foreach($solicitud[0] as $s):
            $resultados[] = $s;
        endforeach;

        return $resultados;*/

        foreach($solicitud[0] as $csd):
            $escuela = Escuela::where('codigo', $csd['codigo_de_la_escuela'])->first();
            $racion = Racion::where('tipo_alimentos', $csd['tipo_de_actividad_alimentos'])->first();

            $sd = new SolicitudDetalles;
            $sd->id_solicitud = $idSolicitud;
            //$sd->fecha = $csd['fecha_de_solicitud'];
            $sd->id_escuela = $escuela->id;
            $sd->mes_de_solicitud = $csd['mes_de_solicitud'];
            $sd->dias_de_solicitud = $csd['dias_de_solicitud']; 
            $sd->ninas_pre_primaria_a_tercero_primaria = $csd['ninas_pre_primaria_a_tercero_primaria']; 
            $sd->ninos_pre_primaria_a_tercero_primaria = $csd['ninos_pre_primaria_a_tercero_primaria'];
            $sd->total_pre_primaria_a_tercero_primaria = $csd['total_pre_primaria_a_tercero_primaria'];
            $sd->ninas_cuarto_a_sexto = $csd['ninas_cuarto_a_sexto'];
            $sd->ninos_cuarto_a_sexto = $csd['ninios_cuarto_sexto'];
            $sd->total_cuarto_a_sexto = $csd['total_cuarto_a_sexto'];
            $sd->total_de_estudiantes = $csd['total_de_estudiantes'];
            $sd->total_de_raciones_de_estudiantes = $csd['total_de_raciones_de_estudiantes']; 
            $sd->total_docentes = $csd['total_docentes'];
            $sd->total_voluntarios = $csd['total_voluntarios'];
            $sd->total_de_docentes_y_voluntarios = $csd['total_de_docentes_y_voluntarios']; 
            $sd->total_de_raciones_de_docentes_y_voluntarios = $csd['total_de_raciones_de_docentes_y_voluntarios'];
            $sd->total_de_personas = $csd['total_de_personas'];
            $sd->total_de_raciones = $csd['total_de_raciones'];
            $sd->tipo_de_actividad_alimentos = $racion->id;
            $sd->numero_de_entrega = $csd['numero_de_entrega'];
            $sd->tipo = $csd['tipo'];
            $sd->save();
        endforeach;

        $datos = [
           
        ];

        return redirect('/admin/solicitudes_despachos')->with('messages', '¡Solicitud creada y guardada con exito!.')
        ->with('typealert', 'success');

    }

    public function getSolicitudMostrar($id){
        $solicitud = Solicitud::with(['entrega', 'usuario','detalles'])->where('id', $id)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return view('admin.solicitudes.mostrar',$datos);
        
    }

}
