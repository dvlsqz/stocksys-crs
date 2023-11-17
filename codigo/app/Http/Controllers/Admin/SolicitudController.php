<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Solicitud, App\Models\SolicitudDetalles,App\Models\Escuela, App\Models\Entrega, App\Models\Ruta, App\Models\RutaEscuela, App\Models\Racion, App\Models\Usuario, App\Models\Bitacora;
use DB, Validator, Auth, Hash, Config, Carbon\Carbon;
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

        $archivo = request()->file('datos');
        $solicitud = Excel::toArray(new SolicitudDetallesImport, $archivo);

        foreach($solicitud[0] as $csd):
            $escuela = Escuela::where('codigo', $csd['codigo_de_la_escuela'])->first();
            $racion = Racion::where('tipo_alimentos', $csd['tipo_de_actividad_alimentos'])->first();

            $sd = new SolicitudDetalles;
            $sd->id_solicitud = $idSolicitud;
            $fecha= intval($csd['fecha_de_solicitud']);
            $sd->fecha = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fecha));
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

        Solicitud::where('id',$idSolicitud)->update(['nombre_archivo'=>$archivo->getClientOriginalName()]);

        $datos = [
           
        ];

        return redirect('/admin/solicitudes_despachos')->with('messages', '¡Solicitud creada y guardada con exito!.')
        ->with('typealert', 'success');

    }

    public function getSolicitudMostrar($id){
        $solicitud = Solicitud::with(['entrega', 'usuario','detalles'])->where('id', $id)->first();
        $total_estudiantes = SolicitudDetalles::where('id_solicitud', $id)->sum('total_de_estudiantes');
        $total_raciones_estudiantes = SolicitudDetalles::where('id_solicitud', $id)->sum('total_de_raciones_de_estudiantes');
        $total_docentes_voluntarios = SolicitudDetalles::where('id_solicitud', $id)->sum('total_de_docentes_y_voluntarios');
        $total_raciones_docentes_voluntarios = SolicitudDetalles::where('id_solicitud', $id)->sum('total_de_raciones_de_docentes_y_voluntarios');
        $total_personas = SolicitudDetalles::where('id_solicitud', $id)->sum('total_de_personas');
        $total_raciones = SolicitudDetalles::where('id_solicitud', $id)->sum('total_de_raciones');

        $datos = [
            'solicitud' => $solicitud,
            'total_estudiantes' => $total_estudiantes,
            'total_raciones_estudiantes' => $total_raciones_estudiantes,
            'total_docentes_voluntarios' => $total_docentes_voluntarios,
            'total_raciones_docentes_voluntarios' => $total_raciones_docentes_voluntarios,
            'total_personas' => $total_personas,
            'total_raciones' => $total_raciones
        ];

        return view('admin.solicitudes.mostrar',$datos);
        
    }

    public function getSolicitudDetallesEditar($id){
        $detalles = SolicitudDetalles::findOrFail($id);
        $escuelas = Escuela::pluck('nombre','id');
        $raciones = Racion::pluck('tipo_alimentos', 'id');

        $datos = [
            'detalles' => $detalles,
            'escuelas' => $escuelas,
            'raciones' => $raciones
        ];

        return view('admin.solicitudes.detalles.editar',$datos);
    }

    public function getSolicitudEliminar($id){
        $solicitud = Solicitud::findOrFail($id);
        $detalles = SolicitudDetalles::where('id_solicitud',$id)->delete();



        if($solicitud->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminacion de solicitud registro (ID): '.$solicitud->id;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Escuela eliminada con exito!.')
                    ->with('typealert', 'warning');
        endif;
    }

    public function getSolicitudDetallesEliminar($id){
        $detalle = SolicitudDetalles::findOrFail($id);

        if($detalle->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminacion de detalle de solicitud registro (ID): '.$detalle->id;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Escuela eliminada con exito!.')
                    ->with('typealert', 'warning');
        endif;
    }

    public function getSolicitudRutas($id){
        $rutas_principales = Ruta::with('detalles')->orderBy('id_ubicacion', 'asc')->get();
        

        /*$escuelas_x_rutas = RutaEscuela::all();
        $escuelas_x_detalle = SolicitudDetalles::where('id_solicitud', $id)->get();

        $detalles = DB::table('solicitud_detalles')
            ->select(
                DB::raw('rutas_escuelas.id_ruta as ruta_principal'),
                DB::raw('escuelas.nombre as escuela'),
                DB::raw('SUM(solicitud_detalles.total_de_raciones) as raciones_escuela')
            )
            ->join('rutas_escuelas', 'rutas_escuelas.id_escuela', 'solicitud_detalles.id_escuela')
            ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
            ->where('solicitud_detalles.id_solicitud','=',$id)
            ->groupBy('rutas_escuelas.id_ruta','solicitud_detalles.id_escuela')
            ->get();*/
        $idSolicitud = $id;
        $datos = [
            'rutas_principales' => $rutas_principales,
            'idSolicitud' => $idSolicitud
        ];

        return view('admin.solicitudes.detalles.rutas',$datos);
    }

    public function getSolicitudRutaDetalle($id, $idRuta){
        $rutas_principales = Ruta::with('detalles')->orderBy('id_ubicacion', 'asc')->get();
        $ruta = Ruta::where('id', $idRuta)->first();
        
        $detalles_ruta_escuelas = DB::table('solicitud_detalles')
            ->select(
                DB::raw('escuelas.id as escuela_id'),
                DB::raw('escuelas.nombre as escuela'),
                DB::raw('rutas_escuelas.orden_llegada as orden_llegada'),
                DB::raw('SUM(solicitud_detalles.total_de_raciones) as total_raciones')
            )
            ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
            ->join('rutas_escuelas', 'rutas_escuelas.id_escuela', 'escuelas.id' )
            ->join('raciones', 'raciones.id', 'solicitud_detalles.tipo_de_actividad_alimentos')
            ->where('solicitud_detalles.id_solicitud', $id)
            ->where('rutas_escuelas.id_ruta', $idRuta)
            ->groupBy('solicitud_detalles.id_escuela')
            ->orderBy('rutas_escuelas.orden_llegada', 'asc')
            ->get();

        $total_raciones = DB::table('solicitud_detalles')
            ->select(               
                DB::raw('SUM(solicitud_detalles.total_de_raciones) as total_raciones')
            )
            ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
            ->join('rutas_escuelas', 'rutas_escuelas.id_escuela', 'escuelas.id' )
            ->join('raciones', 'raciones.id', 'solicitud_detalles.tipo_de_actividad_alimentos')
            ->where('solicitud_detalles.id_solicitud', $id)
            ->where('rutas_escuelas.id_ruta', $idRuta)
            ->first();

        $detalles_solicitud_escuelas = DB::table('solicitud_detalles')
            ->select(
                DB::raw('escuelas.id as escuela_id'),
                DB::raw('raciones.tipo_alimentos as tipo'),
                DB::raw('solicitud_detalles.mes_de_solicitud as mes'),
                DB::raw('solicitud_detalles.total_de_raciones as total_raciones')
            )
            ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
            ->join('raciones', 'raciones.id', 'solicitud_detalles.tipo_de_actividad_alimentos')
            ->where('solicitud_detalles.id_solicitud', $id)
            ->get();

            //return $detalles_solicitud_escuelas;
        

       
        $idSolicitud = $id;
        $datos = [
            'rutas_principales' => $rutas_principales,
            'ruta' => $ruta,
            'idSolicitud' => $idSolicitud,
            'detalles_ruta_escuelas' => $detalles_ruta_escuelas,
            'detalles_solicitud_escuelas' => $detalles_solicitud_escuelas,
            'total_raciones' => $total_raciones
        ];

        return view('admin.solicitudes.detalles.rutas_desgloce',$datos);
    }

}
