<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Bodega, App\Models\BodegaIngreso, App\Models\BodegaIngresoDetalle, App\Models\PesoInsumo, App\Models\Insumo, App\Models\Institucion, App\Models\Bitacora;
use Validator, Auth, Hash, Config, DB, Carbon\Carbon;

class BodegaSocioController extends Controller
{
    public function getInsumos(){
        $insumos = Bodega::where('tipo_bodega',1)->where('id_institucion', Auth::user()->id_institucion)->get();
        $insumo = new Bodega;

        $datos = [
            'insumos' => $insumos,
            'insumo' => $insumo
        ];

        return view('admin.bodega.bodega_socio.inicio', $datos);

    }

    public function postInsumoRegistrar(Request $request){
        $reglas = [

    	];
    	$mensajes = [

    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $b = new Bodega;
            $b->nombre = e($request->input('nombre'));       
            $b->id_unidad_medida = $request->input('id_unidad_medida'); 
            $b->categoria = $request->input('categoria');
            $b->saldo = 0;
            $b->tipo_bodega = 1;   
            $b->id_institucion = Auth::user()->id_institucion;
            $b->observaciones = e($request->input('observaciones'));

            $insumo = $b->nombre;

            if($b->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de insumo '.$insumo.' en la bodega del socio '.Auth::user()->institucion->nombre.' con saldo inicial 0';
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Insumo registrado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getInsumoIngresos(){
        $bodegas = Institucion::where('nivel', 2)->pluck('nombre','id');
        $insumos = Bodega::where('tipo_bodega', 1)->where('id_institucion', Auth::user()->id_institucion)->get();

        $datos = [
            'insumos' => $insumos,
            'bodegas' => $bodegas
        ];
        
        return view('admin.bodega.bodega_socio.ingreso' ,$datos);
    }

    public function postInsumoIngresos(Request $request){
        $reglas = [

    	];
    	$mensajes = [

    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            DB::beginTransaction();

                $bi = new BodegaIngreso;
                $bi->fecha = $request->input('fecha_ingreso');
                $bi->bodega_despacho = $request->input('bodega_despacho');
                $bi->tipo_documento = $request->input('tipo_documento');
                $bi->no_documento = $request->input('no_documento');
                $bi->tipo_bodega = 1;
                $bi->id_institucion = Auth::user()->id_institucion;
                $bi->save();

                $idinsumo=$request->get('idinsumo');
                $pl=$request->get('pl');
                $no_unidades=$request->get('no_unidades');
                $unidad_medida=$request->get('unidad_medida');
                $peso_total=$request->get('peso_total');
                $cont=0;

                while ($cont<count($idinsumo)) {
                    $detalle=new BodegaIngresoDetalle();
                    $detalle->id_ingreso = $bi->id;
                    $detalle->id_insumo = $idinsumo[$cont];
                    $detalle->pl = $pl[$cont];
                    $detalle->no_unidades = $no_unidades[$cont];
                    $detalle->unidad_medida = $unidad_medida[$cont];
                    $detalle->peso_total = $peso_total[$cont];
                    $detalle->save();
                    $cont=$cont+1;
                }

            DB::commit();

            if($bi->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de ingreso de insumos a bodega';
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Ingreso registrado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getInsumoEgreso(){ 
        
    }

    public function getInsumoEliminar($id){
        $insumo = Bodega::findOrFail($id);
        //$detalles = SolicitudDetalles::where('id_solicitud',$id)->delete();

        if($insumo->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminacion de insumo de la bodega socion, con registro (ID): '.$insumo->id;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Insumo eliminado con exito!.')
                    ->with('typealert', 'warning');
        endif;
    }

    public function getInsumoPesos($id){
        $pesos_existen = PesoInsumo::where('id_insumo',$id)->count();
        if($pesos_existen == 0):
            $pesos = new PesoInsumo;
        else:
            $pesos = PesoInsumo::findOrFail($id);
        endif;
        $insumo = Bodega::findOrFail($id);

        $datos = [
            'id' => $id,
            'pesos' => $pesos,
            'insumo' => $insumo
        ];

        return view('admin.bodega.bodega_socio.pesos_insumos',$datos);
    }

    public function postInsumoPesos(Request $request){
        $reglas = [
    		
    	];
    	$mensajes = [
    		
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $datos_ant = PesoInsumo::where('id_insumo',$request->input('id_insumo'))->count();
            if($datos_ant == 0):
                $i = Bodega::findOrFail($request->input('id_insumo'));
                $p = new PesoInsumo;
                $p->id_insumo = $request->input('id_insumo');
                $p->gramos_x_libra = $request->input('gramos_x_libra');
                $p->gramos_x_kg = $request->input('gramos_x_kg');
                $p->libras_x_kg = $request->input('libras_x_kg');
                $p->kg_x_unidad = $request->input('kg_x_unidad');
                $p->gramos_x_unidad = $request->input('gramos_x_unidad');
                $p->libras_x_unidad = $request->input('libras_x_unidad');
                $p->quintales_x_unidad = $request->input('quintales_x_unidad');
                $p->peso_bruto_quintales = $request->input('peso_bruto_quintales');
                $p->tonelada_metrica_kg = $request->input('tonelada_metrica_kg');
                $p->unidades_x_tm = $request->input('unidades_x_tm');

                if($p->save()):
                    $b = new Bitacora;
                    $b->accion = 'Registro de peso de insumo: '.$i->nombre;
                    $b->id_usuario = Auth::id();
                    $b->save();

                    return back()->with('messages', '¡Pesos de insumo creados y guardados con exito!.')
                    ->with('typealert', 'success');
                endif;
            endif;

            if($datos_ant == 1):
                $i = Bodega::findOrFail($request->input('id_insumo'));
                $p = PesoInsumo::findOrFail($request->input('id_insumo'));

                if(empty($request->input('gramos_x_libra'))):
                    $p->gramos_x_libra = $request->input('gramos_x_libra_ant');
                else:
                    $p->gramos_x_libra = $request->input('gramos_x_libra');
                endif;
                
                if(empty($request->input('gramos_x_kg'))):
                    $p->gramos_x_kg = $request->input('gramos_x_kg_ant');
                else:
                    $p->gramos_x_kg = $request->input('gramos_x_kg');
                endif;

                if(empty($request->input('libras_x_kg'))):
                    $p->libras_x_kg  = $request->input('libras_x_kg_ant');
                else:
                    $p->libras_x_kg  = $request->input('libras_x_kg');
                endif;

                if(empty($request->input('kg_x_unidad'))):
                    $p->kg_x_unidad = $request->input('kg_x_unidad_ant');
                else:
                    $p->kg_x_unidad = $request->input('kg_x_unidad');
                endif;

                if(empty($request->input('gramos_x_unidad'))):
                    $p->gramos_x_unidad = $request->input('gramos_x_unidad_ant');
                else:
                    $p->gramos_x_unidad = $request->input('gramos_x_unidad');
                endif;

                if(empty($request->input('libras_x_unidad'))):
                    $p->libras_x_unidad = $request->input('libras_x_unidad_ant');
                else:
                    $p->libras_x_unidad = $request->input('libras_x_unidad');
                endif;

                if(empty($request->input('quintales_x_unidad'))):
                    $p->quintales_x_unidad = $request->input('quintales_x_unidad_ant');
                else:
                    $p->quintales_x_unidad = $request->input('quintales_x_unidad');
                endif;

                if(empty($request->input('peso_bruto_quintales'))):
                    $p->peso_bruto_quintales = $request->input('peso_bruto_quintales_ant');
                else:
                    $p->peso_bruto_quintales = $request->input('peso_bruto_quintales');
                endif;

                if(empty($request->input('tonelada_metrica_kg'))):
                    $p->tonelada_metrica_kg = $request->input('tonelada_metrica_kg_ant');
                else:
                    $p->tonelada_metrica_kg = $request->input('tonelada_metrica_kg');
                endif;
                
                if(empty($request->input('unidades_x_tm'))):
                    $p->unidades_x_tm = $request->input('unidades_x_tm_ant');
                else:
                    $p->unidades_x_tm = $request->input('unidades_x_tm');
                endif;

                if($p->save()):
                    $b = new Bitacora;
                    $b->accion = 'Actualización de pesos de insumo: '.$i->nombre;
                    $b->id_usuario = Auth::id();
                    $b->save();

                    return back()->with('messages', '¡Información actualizada y guardada con exito!.')
                    ->with('typealert', 'info');
                endif;
            endif;
            
        endif;
    }
} 
