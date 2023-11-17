<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Bodega, App\Models\Insumo, App\Models\Institucion, App\Models\Bitacora;
use Validator, Auth, Hash, Config, Carbon\Carbon;

class BodegaController extends Controller
{
    public function getBodegaPrincipalInventario(){
        $insumos = Insumo::pluck('nombre','id');
        $inventario = Bodega::with(['insumo'])->where('tipo_bodega', 0)->get();

        $datos = [
            'insumos' => $insumos,
            'inventario' => $inventario
        ];

        return view('admin.bodega.bodega_principal.inventario', $datos);
    }

    public function postBodegaPrincipalInventarioRegistrar(Request $request){
        $reglas = [

    	];
    	$mensajes = [

    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $b = new Bodega;
            $b->id_insumo = $request->input('id_insumo');
            $b->saldo = 0;
            $b->tipo_bodega = 0;    

            $insumo = Insumo::findOrFail($request->input('id_insumo'));

            if($b->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de insumo '.$insumo->nombre.' en bodega principal con saldo inicial 0';
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Insumo registrado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getBodegaPrincipalIngreso(){
        $datos = [

        ];

        return view('admin.bodega.bodega_principal.ingresos' ,$datos);
        
    }

    public function getBodegaPrincipalEgreso(){
        
    }

    public function getBodegaSocioInventario(){
        $insumos = Insumo::pluck('nombre','id');
        $inventario = Bodega::with(['insumo'])->where('tipo_bodega', 1)->get();

        $datos = [
            'insumos' => $insumos,
            'inventario' => $inventario
        ];

        return view('admin.bodega.bodega_socio.inventario', $datos);

    }

    public function postBodegaSocioInventarioRegistrar(Request $request){
        $reglas = [

    	];
    	$mensajes = [

    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $b = new Bodega;
            $b->id_insumo = $request->input('id_insumo');
            $b->saldo = 0;
            $b->tipo_bodega = 1;    

            $insumo = Insumo::findOrFail($request->input('id_insumo'));

            if($b->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de insumo '.$insumo->nombre.' en bodega socio con saldo inicial 0';
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Insumo registrado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getBodegaSocioIngreso(){
        $bodegas = Institucion::where('nivel', 2)->pluck('nombre','id');
        $insumos = Insumo::pluck('nombre','id');

        $datos = [
            'insumos' => $insumos,
            'bodegas' => $bodegas
        ];
        
        return view('admin.bodega.bodega_socio.ingreso' ,$datos);
    }

    public function getBodegaSocioEgreso(){ 
        
    }
} 
