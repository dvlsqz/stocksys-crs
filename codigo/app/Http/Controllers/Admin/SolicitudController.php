<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Solicitud, App\Models\SolicitudDetalles,App\Models\Escuela, App\Models\Entrega, App\Models\Ruta, App\Models\RutaEscuela,  App\Models\RutaSolicitud,  App\Models\RutaSolicitudDetalles,  App\Models\Racion,App\Models\AlimentoRacion, App\Models\Usuario, App\Models\Bitacora;
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

    public function getSolicitudDetallesRegistrar($id){
        $detalles = new SolicitudDetalles;
        $escuelas = Escuela::pluck('nombre','id');
        $raciones = Racion::pluck('tipo_alimentos', 'id');
        $idSolicitud = $id;
        $registrar = 1;

        $datos = [
            'detalles' => $detalles,
            'escuelas' => $escuelas,
            'raciones' => $raciones,
            'idSolicitud' => $idSolicitud,
            'registrar' => $registrar
        ];

        return view('admin.solicitudes.detalles.registrar',$datos);
    }

    public function postSolicitudDetallesRegistrar(Request $request){
        $reglas = [
            
    	];
    	$mensajes = [
            
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $detalle = new SolicitudDetalles;
            $detalle->id_solicitud = $request->input('id_solicitud');
            $detalle->fecha = $request->input('fecha');
            $detalle->id_escuela = $request->input('id_escuela');
            $detalle->mes_de_solicitud = $request->input('mes_de_solicitud');
            $detalle->dias_de_solicitud = $request->input('dias_de_solicitud'); 
            $detalle->ninas_pre_primaria_a_tercero_primaria = $request->input('ninas_pre_primaria_a_tercero_primaria'); 
            $detalle->ninos_pre_primaria_a_tercero_primaria = $request->input('ninos_pre_primaria_a_tercero_primaria');
            $detalle->total_pre_primaria_a_tercero_primaria = $request->input('total_pre_primaria_a_tercero_primaria');
            $detalle->ninas_cuarto_a_sexto = $request->input('ninas_cuarto_a_sexto');
            $detalle->ninos_cuarto_a_sexto = $request->input('ninos_cuarto_a_sexto');
            $detalle->total_cuarto_a_sexto = $request->input('total_cuarto_a_sexto');
            $detalle->total_de_estudiantes = $request->input('total_de_estudiantes');
            $detalle->total_de_raciones_de_estudiantes = $request->input('total_de_raciones_de_estudiantes'); 
            $detalle->total_docentes = $request->input('total_docentes');
            $detalle->total_voluntarios = $request->input('total_voluntarios');
            $detalle->total_de_docentes_y_voluntarios = $request->input('total_de_docentes_y_voluntarios'); 
            $detalle->total_de_raciones_de_docentes_y_voluntarios = $request->input('total_de_raciones_de_docentes_y_voluntarios');
            $detalle->total_de_personas = $request->input('total_de_personas');
            $detalle->total_de_raciones = $request->input('total_de_raciones');
            $detalle->tipo_de_actividad_alimentos = $request->input('tipo_de_actividad_alimentos');
            $detalle->numero_de_entrega = $request->input('numero_de_entrega');
            $detalle->tipo = $request->input('tipo');
            $id = $detalle->id;
            $idSolicitud = $detalle->id_solicitud;

            if($detalle->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de información de la escuela de solicitud con registro (ID): '.$id;
                $b->id_usuario = Auth::id();
                $b->save();

                return redirect('/admin/solicitud_despacho/'.$idSolicitud.'/mostrar')->with('messages', '¡Información registrar y guardada con exito!.')
                ->with('typealert', 'info');
    		endif;
        endif;
    }

    public function getSolicitudDetallesEditar($id){
        $detalles = SolicitudDetalles::findOrFail($id);
        $escuelas = Escuela::pluck('nombre','id');
        $raciones = Racion::pluck('tipo_alimentos', 'id');
        $registrar = 0;

        $datos = [
            'detalles' => $detalles,
            'escuelas' => $escuelas,
            'raciones' => $raciones,
            'registrar' => $registrar
        ];

        return view('admin.solicitudes.detalles.editar',$datos);
    }   

    public function postSolicitudDetallesEditar(Request $request, $id){
        $reglas = [
            
    	];
    	$mensajes = [
            
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $detalle = SolicitudDetalles::findOrFail($id);
            $detalle->id_solicitud = $request->input('id_solicitud');
            $detalle->fecha = $request->input('fecha');
            $detalle->id_escuela = $request->input('id_escuela');
            $detalle->mes_de_solicitud = $request->input('mes_de_solicitud');
            $detalle->dias_de_solicitud = $request->input('dias_de_solicitud'); 
            $detalle->ninas_pre_primaria_a_tercero_primaria = $request->input('ninas_pre_primaria_a_tercero_primaria'); 
            $detalle->ninos_pre_primaria_a_tercero_primaria = $request->input('ninos_pre_primaria_a_tercero_primaria');
            $detalle->total_pre_primaria_a_tercero_primaria = $request->input('total_pre_primaria_a_tercero_primaria');
            $detalle->ninas_cuarto_a_sexto = $request->input('ninas_cuarto_a_sexto');
            $detalle->ninos_cuarto_a_sexto = $request->input('ninos_cuarto_a_sexto');
            $detalle->total_cuarto_a_sexto = $request->input('total_cuarto_a_sexto');
            $detalle->total_de_estudiantes = $request->input('total_de_estudiantes');
            $detalle->total_de_raciones_de_estudiantes = $request->input('total_de_raciones_de_estudiantes'); 
            $detalle->total_docentes = $request->input('total_docentes');
            $detalle->total_voluntarios = $request->input('total_voluntarios');
            $detalle->total_de_docentes_y_voluntarios = $request->input('total_de_docentes_y_voluntarios'); 
            $detalle->total_de_raciones_de_docentes_y_voluntarios = $request->input('total_de_raciones_de_docentes_y_voluntarios');
            $detalle->total_de_personas = $request->input('total_de_personas');
            $detalle->total_de_raciones = $request->input('total_de_raciones');
            $detalle->tipo_de_actividad_alimentos = $request->input('tipo_de_actividad_alimentos');
            $detalle->numero_de_entrega = $request->input('numero_de_entrega');
            $detalle->tipo = $request->input('tipo');
            $idSolicitud = $detalle->id_solicitud;

            if($detalle->save()):
                $b = new Bitacora;
                $b->accion = 'Edición de información de la escuela de solicitud con registro (ID): '.$id;
                $b->id_usuario = Auth::id();
                $b->save();

                return redirect('/admin/solicitud_despacho/'.$idSolicitud.'/mostrar')->with('messages', '¡Información actualizada y guardada con exito!.')
                ->with('typealert', 'info');
    		endif;
        endif;
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
                    DB::raw("CONCAT(escuelas.nombre, ' (',escuelas.codigo,')') as escuela"),
                    DB::raw('rutas_escuelas.orden_llegada as orden_llegada'),
                    DB::raw('SUM(solicitud_detalles.total_de_raciones) as total_raciones')
                )
                ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
                ->join('rutas_escuelas', 'rutas_escuelas.id_escuela', 'escuelas.id' )
                ->join('raciones', 'raciones.id', 'solicitud_detalles.tipo_de_actividad_alimentos')
                ->where('solicitud_detalles.id_solicitud', $id)
                ->where('rutas_escuelas.id_ruta', $idRuta)
                ->groupBy('solicitud_detalles.id_escuela', 'escuelas.id','escuelas.codigo',  'escuelas.nombre', 'rutas_escuelas.orden_llegada')
                ->orderBy('rutas_escuelas.orden_llegada', 'asc')
                ->get();
        
        $idSolicitud = $id;
        
        $escuelas = DB::table('escuelas')
                    ->join('rutas_escuelas', 'rutas_escuelas.id_escuela','escuelas.id')
                    ->where('rutas_escuelas.id_ruta', $idRuta)
                    ->get();

        $nombre_ruta = $ruta->ubicacion->nomenclatura.'0'.$ruta->correlativo;

        $ruta_despacho = RutaSolicitud::with('detalles')
            ->where('id_ruta_base', $idRuta)
            ->where('nombre',$nombre_ruta)
            ->where('deleted_at', null)
            ->first();        
        $sub_rutas = RutaSolicitud::with('detalles')
            ->where('id_ruta_base', $idRuta)
            ->whereNot('nombre',$nombre_ruta)
            ->where('deleted_at', null)
            ->get();

        $detalle_escuelas = DB::table('solicitud_detalles')
            ->select(
                DB::raw('escuelas.id as escuela_id'),
                DB::raw('solicitud_detalles.tipo_de_actividad_alimentos as racion'),
                DB::raw('( ( SUM(Distinct solicitud_detalles.dias_de_solicitud) * alimentos_racion.peso * SUM(Distinct solicitud_detalles.total_pre_primaria_a_tercero_primaria) + SUM(Distinct solicitud_detalles.dias_de_solicitud) * alimentos_racion.peso * SUM(Distinct solicitud_detalles.total_cuarto_a_sexto) + SUM(Distinct solicitud_detalles.dias_de_solicitud) * alimentos_racion.peso * SUM(Distinct solicitud_detalles.total_de_docentes_y_voluntarios)  ) ) as peso')
            )
            ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
            ->join(DB::RAW("(SELECT id_racion, SUM(cantidad) as peso FROM alimentos_raciones GROUP BY id_racion) as alimentos_racion"), function($j){
                $j->on("alimentos_racion.id_racion","=","solicitud_detalles.tipo_de_actividad_alimentos");
            })
            ->where('solicitud_detalles.id_solicitud', $id)            
            ->where('solicitud_detalles.deleted_at', null)
            ->whereIn('solicitud_detalles.tipo_de_actividad_alimentos', [1,2,3])
            ->groupBy('escuelas.id', 'solicitud_detalles.tipo_de_actividad_alimentos')
            ->get();

        $tipo_ruta;
        if(isset($ruta_despacho) ): 
            $tipo_ruta = 0;
        elseif(count($sub_rutas) > 0):
            $tipo_ruta = 1;
        else:
            $tipo_ruta = 2;    
        endif;


        if(count($detalles_ruta_escuelas) > 0):
            $idEscuelas;
            foreach($detalles_ruta_escuelas as $det):
                $idEscuelas[] = $det->escuela_id;
            endforeach;


            $det_escuelas_preprimaria =  DB::table('solicitud_detalles')
                ->select(
                    DB::raw('escuelas.id as escuela_id'),
                    DB::raw('SUM(Distinct solicitud_detalles.dias_de_solicitud) as dias'),
                    DB::raw('SUM(Distinct solicitud_detalles.total_pre_primaria_a_tercero_primaria) as total_ninos'),
                    DB::raw('solicitud_detalles.tipo_de_actividad_alimentos as racion'),
                    DB::raw('alimentos_racion.peso as peso_racion')
                )
                ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
                ->join(DB::RAW("(SELECT id_racion, SUM(cantidad) as peso FROM alimentos_raciones GROUP BY id_racion) as alimentos_racion"), function($j){
                    $j->on("alimentos_racion.id_racion","=","solicitud_detalles.tipo_de_actividad_alimentos");
                })
                ->where('solicitud_detalles.id_solicitud', $id)
                ->whereIn('solicitud_detalles.id_escuela', $idEscuelas)
                ->where('solicitud_detalles.tipo_de_actividad_alimentos', 1)                
                ->where('solicitud_detalles.deleted_at', null)
                ->groupBy('escuelas.id', 'solicitud_detalles.tipo_de_actividad_alimentos', 'alimentos_racion.peso')
                ->get();

                    //return $det_escuelas_preprimaria;
            $det_escuelas_primaria = DB::table('solicitud_detalles')
                ->select(
                    DB::raw('escuelas.id as escuela_id'),
                    DB::raw('SUM(Distinct solicitud_detalles.dias_de_solicitud) as dias'),
                    DB::raw('SUM(Distinct solicitud_detalles.total_cuarto_a_sexto) as total_ninos'),
                    DB::raw('solicitud_detalles.tipo_de_actividad_alimentos as racion'),
                    DB::raw('alimentos_racion.peso as peso_racion')
                )
                ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
                ->join(DB::RAW("(SELECT id_racion, SUM(cantidad) as peso FROM alimentos_raciones GROUP BY id_racion) as alimentos_racion"), function($j){
                    $j->on("alimentos_racion.id_racion","=","solicitud_detalles.tipo_de_actividad_alimentos");
                })
                ->where('solicitud_detalles.id_solicitud', $id)
                ->whereIn('solicitud_detalles.id_escuela', $idEscuelas)
                ->where('solicitud_detalles.tipo_de_actividad_alimentos', 1)                
                ->where('solicitud_detalles.deleted_at', null)
                ->groupBy('escuelas.id','solicitud_detalles.tipo_de_actividad_alimentos', 'alimentos_racion.peso')
                ->get();
                //return $det_escuelas_preprimaria;
            $det_escuelas_l = DB::table('solicitud_detalles')
                ->select(
                    DB::raw('escuelas.id as escuela_id'),
                    DB::raw('SUM(Distinct solicitud_detalles.dias_de_solicitud) as dias'),
                    DB::raw('SUM(Distinct solicitud_detalles.total_de_docentes_y_voluntarios) as total_personas'),
                    DB::raw('solicitud_detalles.tipo_de_actividad_alimentos as racion'),
                    DB::raw('alimentos_racion.peso as peso_racion')
                )
                ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
                ->join(DB::RAW("(SELECT id_racion, SUM(cantidad) as peso FROM alimentos_raciones GROUP BY id_racion) as alimentos_racion"), function($j){
                    $j->on("alimentos_racion.id_racion","=","solicitud_detalles.tipo_de_actividad_alimentos");
                })
                ->where('solicitud_detalles.id_solicitud', $id)
                ->whereIn('solicitud_detalles.id_escuela', $idEscuelas)
                ->where('solicitud_detalles.tipo_de_actividad_alimentos',2)                
                ->where('solicitud_detalles.deleted_at', null)
                ->groupBy('escuelas.id','solicitud_detalles.tipo_de_actividad_alimentos', 'alimentos_racion.peso')
                ->get();

            $det_escuelas_v_d = DB::table('solicitud_detalles')
                ->select(
                    DB::raw('escuelas.id as escuela_id'),
                    DB::raw('SUM(Distinct solicitud_detalles.dias_de_solicitud) as dias'),
                    DB::raw('SUM(Distinct solicitud_detalles.total_de_docentes_y_voluntarios) as total_personas'),
                    DB::raw('solicitud_detalles.tipo_de_actividad_alimentos as racion'),
                    DB::raw('alimentos_racion.peso as peso_racion')
                )
                ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
                ->join(DB::RAW("(SELECT id_racion, SUM(cantidad) as peso FROM alimentos_raciones GROUP BY id_racion) as alimentos_racion"), function($j){
                    $j->on("alimentos_racion.id_racion","=","solicitud_detalles.tipo_de_actividad_alimentos");
                })
                ->where('solicitud_detalles.id_solicitud', $id)
                ->whereIn('solicitud_detalles.id_escuela', $idEscuelas)
                ->where('solicitud_detalles.tipo_de_actividad_alimentos', 3)
                ->where('solicitud_detalles.deleted_at', null)
                ->groupBy('escuelas.id','solicitud_detalles.tipo_de_actividad_alimentos', 'alimentos_racion.peso')
                ->get();

        
            
            
            $datos = [
                'rutas_principales' => $rutas_principales,
                'ruta' => $ruta,
                'ruta_despacho' => $ruta_despacho,
                'sub_rutas' => $sub_rutas,
                'tipo_ruta' => $tipo_ruta,
                'escuelas' => $escuelas,
                'idSolicitud' => $idSolicitud,
                'detalles_ruta_escuelas' => $detalles_ruta_escuelas,
                'det_escuelas_preprimaria' => $det_escuelas_preprimaria,
                'det_escuelas_primaria' => $det_escuelas_primaria,
                'det_escuelas_v_d' => $det_escuelas_v_d,
                'det_escuelas_l' => $det_escuelas_l,
                'detalle_escuelas' => $detalle_escuelas
            ];

        else:
            $datos = [
                'rutas_principales' => $rutas_principales,
                'ruta' => $ruta,
                'ruta_despacho' => $ruta_despacho,
                'sub_rutas' => $sub_rutas,
                'tipo_ruta' => $tipo_ruta,
                'escuelas' => $escuelas,
                'idSolicitud' => $idSolicitud,
                'detalles_ruta_escuelas' => $detalles_ruta_escuelas,
                'detalle_escuelas' => $detalle_escuelas
            ];

        endif;        

        return view('admin.solicitudes.detalles.rutas_desgloce',$datos);
    }

    public function postSolicitudRutaConfirmar(Request $request){
        $idSolicitud = $request->input('id_solicitud');
        $ruta_base = $request->input('ruta_base');
        $nombre_ruta = e($request->input('nombre_ruta_solicitud'));
        $escuelas = RutaEscuela::select('id_escuela', 'orden_llegada')->where('id_ruta', $ruta_base)->get();

        DB::beginTransaction();
            $ruta_solicitud = new RutaSolicitud;
            $ruta_solicitud->id_solicitud_despacho = $idSolicitud;
            $ruta_solicitud->id_ruta_base = $ruta_base;
            $ruta_solicitud->nombre = $nombre_ruta;
            $ruta_solicitud->save();

            foreach($escuelas as $escuela):
                $detalle = new RutaSolicitudDetalles;
                $detalle->id_ruta_despacho = $ruta_solicitud->id;
                $detalle->id_escuela= $escuela->id_escuela;
                $detalle->orden_llegada= $escuela->orden_llegada;
                $detalle->save();
            endforeach;

        DB::commit();
 
        if($ruta_solicitud->save()):
            $b = new Bitacora;
            $b->accion = 'Confirmación de ruta '.$nombre_ruta.' sin fraccionar';
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Confirmación de ruta sin fraccionar!.')
                ->with('typealert', 'success');
        endif;
    }

    public function getSolicitudRutaConfirmadaEliminar($id){
        $ruta = RutaSolicitud::findOrFail($id);
        $detalles = RutaSolicitudDetalles::where('id_ruta_despacho',$id)->delete();

        $nombre = $ruta->nombre;
        $solicitud = $ruta->id_solicitud;


        if($ruta->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminacion de ruta '.$nombre.' de la solicitud (ID): '.$solicitud;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Escuela eliminada con exito!.')
                    ->with('typealert', 'warning');
        endif;

    }

    public function postSolicitudCrearSubRuta(Request $request){       
        $abecedario = range('A','Z');
        $ruta_base = $request->input('ruta_base');
        $ruta_nombre_base = e($request->input('nombre_ruta_solicitud'));
        $conteo_ruta = RutaSolicitud::where('id_ruta_base', $ruta_base)->where('deleted_at', null)->count();
        $idSolicitud = $request->input('id_solicitud');

        $ruta_solicitud = new RutaSolicitud;
        $ruta_solicitud->id_solicitud_despacho = $idSolicitud;
        $ruta_solicitud->id_ruta_base = $ruta_base;
        $ruta_solicitud->nombre = $ruta_nombre_base.$abecedario[$conteo_ruta];

        if($ruta_solicitud->save()):
            $b = new Bitacora;
            $b->accion = 'Creacion de sub-ruta con exito';
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Creacion de sub-ruta con exito!.')
                ->with('typealert', 'success');
        endif;
    }

    public function postSolicitudAsignarEscuelaSubRuta(Request $request){       

        $detalle = new RutaSolicitudDetalles;
        $detalle->id_ruta_despacho = $request->input('id_sub_ruta_despacho');
        $detalle->id_escuela= $request->input('id_escuela');
        $detalle->orden_llegada= $request->input('orden_llegada');

        if($detalle->save()):
            $b = new Bitacora;
            $b->accion = 'Asignacion de escuela a sub ruta con exito';
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Asignacion de escuela a sub ruta con exito!.')
                ->with('typealert', 'success');
        endif;
    }

    public function getSolicitudEscuelaSubRutaEliminar($id){
        $escuela_sub_ruta = RutaSolicitudDetalles::findOrFail($id);


        if($escuela_sub_ruta->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminacion de escuela a sub ruta asignada';
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Escuela eliminada de sub ruta con exito!.')
                    ->with('typealert', 'warning');
        endif;

    }

    public function getSolicitudSubRutaEliminar($id){
        $ruta = RutaSolicitud::findOrFail($id);
        $detalles = RutaSolicitudDetalles::where('id_ruta_despacho',$id)->delete();

        $nombre = $ruta->nombre;
        $solicitud = $ruta->id_solicitud;


        if($ruta->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminacion de sub ruta '.$nombre.' de la solicitud (ID): '.$solicitud;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Sub ruta eliminada con exito!.')
                    ->with('typealert', 'warning');
        endif;

    }

    public function getSolicitudRutasConfirmadas($id){
        $idSolicitud = $id;
        $rutas = RutaSolicitud::with('ruta_base')->where('id_solicitud_despacho',$id)->get();
        $detalle_escuelas = DB::table('solicitud_detalles')
            ->select(
                DB::raw('escuelas.id as escuela_id'),
                DB::raw('solicitud_detalles.tipo_de_actividad_alimentos as racion'),
                DB::raw('( ( SUM(Distinct solicitud_detalles.dias_de_solicitud) * alimentos_racion.peso * SUM(Distinct solicitud_detalles.total_pre_primaria_a_tercero_primaria) + SUM(Distinct solicitud_detalles.dias_de_solicitud) * alimentos_racion.peso * SUM(Distinct solicitud_detalles.total_cuarto_a_sexto) + SUM(Distinct solicitud_detalles.dias_de_solicitud) * alimentos_racion.peso * SUM(Distinct solicitud_detalles.total_de_docentes_y_voluntarios)  ) ) as peso')
            )
            ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
            ->join(DB::RAW("(SELECT id_racion, SUM(cantidad) as peso FROM alimentos_raciones GROUP BY id_racion) as alimentos_racion"), function($j){
                $j->on("alimentos_racion.id_racion","=","solicitud_detalles.tipo_de_actividad_alimentos");
            })
            ->where('solicitud_detalles.id_solicitud', $id)            
            ->where('solicitud_detalles.deleted_at', null)
            ->whereIn('solicitud_detalles.tipo_de_actividad_alimentos', [1,2,3])
            ->groupBy('escuelas.id', 'solicitud_detalles.tipo_de_actividad_alimentos')
            ->get();


        

        $datos = [
            'rutas' => $rutas,
            'idSolicitud' => $idSolicitud,
            'detalle_escuelas' => $detalle_escuelas
        ];


        return view('admin.solicitudes.rutas_confirmadas',$datos);

    }

    public function getEscuelasDespacho($id_solicitud){
        $escuelas = SolicitudDetalles::with('escuela')->select('id_escuela')->where('id_solicitud', $id_solicitud)->groupBy('id_escuela')->get();

        $datos = [
            'escuelas' => $escuelas
        ];

        return response()->json($datos);
    }

    public function getEscuelasPruebas($id){
        $detalles_escuelas = DB::table('solicitud_detalles')
            ->select(
                DB::raw('escuelas.id as escuela_id'),
                DB::raw('solicitud_detalles.tipo_de_actividad_alimentos as racion'),
                DB::raw('( ( SUM(Distinct solicitud_detalles.dias_de_solicitud) * alimentos_racion.peso * SUM(Distinct solicitud_detalles.total_pre_primaria_a_tercero_primaria) + SUM(Distinct solicitud_detalles.dias_de_solicitud) * alimentos_racion.peso * SUM(Distinct solicitud_detalles.total_cuarto_a_sexto) + SUM(Distinct solicitud_detalles.dias_de_solicitud) * alimentos_racion.peso * SUM(Distinct solicitud_detalles.total_de_docentes_y_voluntarios)  ) ) as peso')
            )
            ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
            ->join(DB::RAW("(SELECT id_racion, SUM(cantidad) as peso FROM alimentos_raciones GROUP BY id_racion) as alimentos_racion"), function($j){
                $j->on("alimentos_racion.id_racion","=","solicitud_detalles.tipo_de_actividad_alimentos");
            })
            ->where('solicitud_detalles.id_solicitud', $id)            
            ->where('solicitud_detalles.deleted_at', null)
            ->whereIn('solicitud_detalles.tipo_de_actividad_alimentos', [1,2,3])
            ->groupBy('escuelas.id', 'solicitud_detalles.tipo_de_actividad_alimentos')
            ->get();

        /*$detalles_escuelas = DB::table('solicitud_detalles')
            ->select(
                DB::raw('escuelas.id as escuela_id'),
                DB::raw('solicitud_detalles.tipo_de_actividad_alimentos as racion'),
                DB::raw('( ( SUM(Distinct solicitud_detalles.dias_de_solicitud) * alimentos_racion.peso * SUM(Distinct solicitud_detalles.total_pre_primaria_a_tercero_primaria) + SUM(Distinct solicitud_detalles.dias_de_solicitud) * alimentos_racion.peso * SUM(Distinct solicitud_detalles.total_cuarto_a_sexto) + SUM(Distinct solicitud_detalles.dias_de_solicitud) * alimentos_racion.peso * SUM(Distinct solicitud_detalles.total_de_docentes_y_voluntarios)  ) ) as peso')
            )
            ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
            ->join(DB::RAW("(SELECT id_racion, SUM(cantidad) as peso FROM alimentos_raciones GROUP BY id_racion) as alimentos_racion"), function($j){
                $j->on("alimentos_racion.id_racion","=","solicitud_detalles.tipo_de_actividad_alimentos");
            })
            ->where('solicitud_detalles.id_solicitud', $id)            
            ->where('solicitud_detalles.deleted_at', null)
            ->whereIn('solicitud_detalles.tipo_de_actividad_alimentos', [1,2,3])
            ->groupBy('escuelas.id', 'solicitud_detalles.tipo_de_actividad_alimentos')
            ->get();*/


        return $detalles_escuelas;

    }




}
