<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Bodega, App\Models\BodegaIngreso, App\Models\BodegaIngresoDetalle, App\Models\PesoInsumo, App\Models\Insumo, App\Models\Institucion, App\Models\Bitacora;
use Validator, Auth, Hash, Config, DB, Carbon\Carbon;

class BodegaPrincipalController extends Controller
{
    public function getInsumos(){
        $insumos = Bodega::where('tipo_bodega',0)->where('id_institucion', Auth::user()->id_institucion)->get();
        $insumo = new Bodega;

        $datos = [
            'insumos' => $insumos,
            'insumo' => $insumo
        ];

        return view('admin.bodega.bodega_principal.inicio', $datos);

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
            $b->tipo_bodega = 0;   
            $b->id_institucion = Auth::user()->id_institucion;
            $b->observaciones = e($request->input('observaciones'));

            $insumo = $b->nombre;

            if($b->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de insumo '.$insumo.' en la bodega principal '.Auth::user()->institucion->nombre.' con saldo inicial 0';
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Insumo registrado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getInsumoIngresos(){
        $bodegas = Institucion::where('nivel', 2)->pluck('nombre','id');
        $insumos = Bodega::where('tipo_bodega', 0)->where('id_institucion', Auth::user()->id_institucion)->get();

        $datos = [
            'insumos' => $insumos,
            'bodegas' => $bodegas
        ];
        
        return view('admin.bodega.bodega_principal.ingreso' ,$datos);
    }
}
