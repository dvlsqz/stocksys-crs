<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Exports\InformeMensualExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Bodega, App\Models\Institucion, App\Models\Solicitud;
use Validator, Auth, Hash, Config, Carbon\Carbon;
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
        
        $solicitud = Solicitud::with('detalles')->where('id', $request->input('id_solicitud'))->where('id_socio',$request->input('id_socio'))->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return view('admin.reportes.panel_generado',$datos);
    }

    public function getSociosSolicitudes($id){       
        $solicitudes = Solicitud::where('id_socio', $id)->get();


        $datos = [
            'solicitudes' => $solicitudes
        ];

        return response()->json($datos);
    }
}
