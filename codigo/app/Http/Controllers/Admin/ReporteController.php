<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Exports\InformeMensualExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Bodega, App\Models\Institucion, App\Models\Solicitud;
use DB, Validator, Auth, Hash, Config, Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class ReporteController extends Controller
{
    public function getInicio(){       
        


        $datos = [
        ];

        return view('admin.reportes.inicio',$datos);
    }

    public function postInformeMensualExport() 
    {
        $alimentos = Bodega::where('categoria' , 0)->where('tipo_bodega',1)->where('id_institucion', Auth::user()->id_institucion)->get();
        
        //return $alimentos;
        //return Excel::download(new InformeMensualExport, 'informe mensual.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
        return Excel::download(new InformeMensualExport, 'informe mensual.xlsx');
    }

    public function getPanelReporte(){       
        if(Auth::user()->rol == 0):
            $socio = Institucion::where('nivel', 1)->get();
        else:
            $socio = Institucion::where('id', Auth::user()->id_institucion)->get();
        endif;


        $datos = [
            'socio' => $socio
        ];

        return view('admin.reportes.panel',$datos);
    }

    public function postPanelReporteGenerar(Request $request){     

        switch($request->input('num_reporte')):
            case 1:
                //$this->reporte1($request->input('id_solicitud'), $request->input('id_socio'));
                return view('admin.reportes.reporte1',$this->reporte1($request->input('id_solicitud'), $request->input('id_socio')));
            break;

            case 2:
                //return $this->reporte2($request->input('id_solicitud'), $request->input('id_socio'));
                return view('admin.reportes.reporte1',$this->reporte2($request->input('id_solicitud'), $request->input('id_socio')));
            break;

            case 3:
                //return $this->reporte3($request->input('id_solicitud'), $request->input('id_socio'));
                return view('admin.reportes.reporte1',$this->reporte3($request->input('id_solicitud'), $request->input('id_socio')));
            break;

            case 4:
                return $this->reporte4($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 5:
                return $this->reporte5($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 6:
                return $this->reporte6($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 7:
                return $this->reporte7($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 8:
                return $this->reporte8($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 9:
                return $this->reporte9($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 10:
                return $this->reporte10($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 11:
                return $this->reporte11($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 12:
                return $this->reporte12($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 13:
                return $this->reporte13($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 14:
                return $this->reporte14($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 15:
                return $this->reporte15($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 16:
                return $this->reporte16($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 17:
                return $this->reporte17($request->input('id_solicitud'), $request->input('id_socio'));
            break;


        endswitch;
        
        

        $datos = [
            'solicitud' => $solicitud
        ];

        //return view('admin.reportes.panel_generado',$datos);
    }

    public function reporte1($idSolicitud = null, $idSocio = null){
        $solicitud = DB::table('solicitudes as s')
            ->select(
                DB::RAW('Distinct e.id as escuela_id'),
                DB::RAW('e.nombre as escuela_nombre'),
                'r.nombre as racion',
                'be.id as egreso'
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')
            ->join('raciones as r', 'r.id', 'be.tipo_racion')
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->get();

        $alimentos = DB::table('solicitudes as s')
            ->select(
                DB::RAW('Distinct e.id as escuela_id'),
                DB::RAW('e.nombre as escuela_nombre'),
                'r.nombre as racion',
                'a.nombre as insumo',
                'be_det.no_unidades as cantidad'
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')            
            ->join('raciones as r', 'r.id', 'be.tipo_racion')
            ->join('bodegas_egresos_detalles as be_det', 'be_det.id_egreso', 'be.id')  
            ->join('bodegas as a', 'a.id', 'be_det.id_insumo')  
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->get();

        $total_escuelas = DB::table('solicitudes as s')
            ->select(
                DB::RAW('COUNT(Distinct det.id_escuela) as total'),
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->get();

        $datos = [
            'solicitud' => $solicitud,
            'alimentos' => $alimentos,
            'total_escuelas' => $total_escuelas
        ];

        return $datos;
    }

    public function reporte2($idSolicitud = null, $idSocio = null){
        $alimento = 'Maiz USDA';
        $solicitud = DB::table('solicitudes as s')
            ->select(
                DB::RAW('Distinct e.id as escuela_id'),
                DB::RAW('e.nombre as escuela_nombre'),
                'r.nombre as racion',
                'be.id as egreso'
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')            
            ->join('raciones as r', 'r.id', 'be.tipo_racion')
            ->join('bodegas_egresos_detalles as be_det', 'be_det.id_egreso', 'be.id')  
            ->join('bodegas as a', 'a.id', 'be_det.id_insumo')  
            ->where('a.nombre','LIKE',"%{$alimento}%")
            ->where('be_det.no_unidades', '>', 0)
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->get();

        $alimentos = DB::table('solicitudes as s')
            ->select(
                DB::RAW('Distinct e.id as escuela_id'),
                DB::RAW('e.nombre as escuela_nombre'),
                'r.nombre as racion',
                'a.nombre as insumo',
                'be_det.no_unidades as cantidad'
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')            
            ->join('raciones as r', 'r.id', 'be.tipo_racion')
            ->join('bodegas_egresos_detalles as be_det', 'be_det.id_egreso', 'be.id')  
            ->join('bodegas as a', 'a.id', 'be_det.id_insumo')  
            ->where('a.nombre','LIKE',"%{$alimento}%")
            ->where('be_det.no_unidades', '>', 0)
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->get();

        $total_escuelas = DB::table('solicitudes as s')
            ->select(
                DB::RAW('COUNT(Distinct det.id_escuela) as total'),
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')            
            ->join('raciones as r', 'r.id', 'be.tipo_racion')
            ->join('bodegas_egresos_detalles as be_det', 'be_det.id_egreso', 'be.id')  
            ->join('bodegas as a', 'a.id', 'be_det.id_insumo')  
            ->where('a.nombre','LIKE',"%{$alimento}%")
            ->where('be_det.no_unidades', '>', 0)
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->get();

        $datos = [
            'solicitud' => $solicitud,
            'alimentos' => $alimentos,
            'total_escuelas' => $total_escuelas
        ];

        return $datos;
    }

    public function reporte3($idSolicitud = null, $idSocio = null){
        $alimento = 'Maiz bio';
        $solicitud = DB::table('solicitudes as s')
            ->select(
                DB::RAW('Distinct e.id as escuela_id'),
                DB::RAW('e.nombre as escuela_nombre'),
                'r.nombre as racion',
                'be.id as egreso'
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')            
            ->join('raciones as r', 'r.id', 'be.tipo_racion')
            ->join('bodegas_egresos_detalles as be_det', 'be_det.id_egreso', 'be.id')  
            ->join('bodegas as a', 'a.id', 'be_det.id_insumo')  
            ->where('a.nombre','LIKE',"%{$alimento}%")
            ->where('be_det.no_unidades', '>', 0)
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->get();

        $alimentos = DB::table('solicitudes as s')
            ->select(
                DB::RAW('Distinct e.id as escuela_id'),
                DB::RAW('e.nombre as escuela_nombre'),
                'r.nombre as racion',
                'a.nombre as insumo',
                'be_det.no_unidades as cantidad'
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')            
            ->join('raciones as r', 'r.id', 'be.tipo_racion')
            ->join('bodegas_egresos_detalles as be_det', 'be_det.id_egreso', 'be.id')  
            ->join('bodegas as a', 'a.id', 'be_det.id_insumo')  
            ->where('a.nombre','LIKE',"%{$alimento}%")
            ->where('be_det.no_unidades', '>', 0)
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->get();

        $total_escuelas = DB::table('solicitudes as s')
            ->select(
                DB::RAW('COUNT(Distinct det.id_escuela) as total'),
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')            
            ->join('raciones as r', 'r.id', 'be.tipo_racion')
            ->join('bodegas_egresos_detalles as be_det', 'be_det.id_egreso', 'be.id')  
            ->join('bodegas as a', 'a.id', 'be_det.id_insumo')  
            ->where('a.nombre','LIKE',"%{$alimento}%")
            ->where('be_det.no_unidades', '>', 0)
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->get();

        $datos = [
            'solicitud' => $solicitud,
            'alimentos' => $alimentos,
            'total_escuelas' => $total_escuelas
        ];

        return $datos;
    }

    public function reporte4($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte5($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte6($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte7($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte8($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte9($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte10($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte11($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte12($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte13($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte14($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte15($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte16($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte17($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function getSociosSolicitudes($id){       
        $solicitudes = Solicitud::where('id_socio', $id)->get();


        $datos = [
            'solicitudes' => $solicitudes
        ];

        return response()->json($datos);
    }
}
