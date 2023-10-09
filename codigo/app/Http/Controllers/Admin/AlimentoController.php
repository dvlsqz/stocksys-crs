<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Alimento, App\Models\Bitacora;
use Validator, Auth, Hash, Config, Carbon\Carbon;

class AlimentoController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getInicio(){
        $alimentos = Alimento::get();
        $alimento = new Alimento;

        $datos = [
            'alimentos' => $alimentos,
            'alimento' => $alimento
        ];

        return view('admin.alimentos.inicio',$datos);
    }


    public function postAlimentoRegistrar(Request $request){
        $reglas = [
    		'nombre' => 'required'
    	];
    	$mensajes = [
    		'nombre.required' => 'Se requiere un nombre para el alimento.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $a = new Alimento;
            $a->nombre = e($request->input('nombre'));       
            $a->id_unidad_medida = $request->input('id_unidad_medida');
            $a->saldo_bodega_principal = 0;     
            $a->saldo_bodega_socio = 0;   
            $a->observaciones = e($request->input('observaciones'));
            $a->id_institucion = Auth::user()->id_institucion;

            if($a->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de alimento: '.$a->nombre.' con saldo inicial 0';
                $b->id_usuario = Auth::id();
                $b->save();

                return redirect('/admin/alimentos')->with('messages', '¡Alimento creado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getAlimentoEditar($id){
        $alimento = Alimento::findOrFail($id);
        
        $datos = [
            'alimento' => $alimento
        ];

        return view('admin.alimentos.editar',$datos);
    }

    public function postAlimentoEditar(Request $request, $id){
        $reglas = [
    		'nombre' => 'required'
    	];
    	$mensajes = [
    		'nombre.required' => 'Se requiere un nombre para el alimento.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $a = Alimento::findOrFail($id);
            $a->nombre = e($request->input('nombre'));
            $a->id_unidad_medida = $request->input('id_unidad_medida');
            $a->observaciones = e($request->input('observaciones'));

            if($a->save()):
                $b = new Bitacora;
                $b->accion = 'Edición de información de alimento: '.$a->nombre;
                $b->id_usuario = Auth::id();
                $b->save();

                return redirect('/admin/alimentos')->with('messages', '¡Información actualizada y guardada con exito!.')
                ->with('typealert', 'info');
    		endif;
        endif;
    }

    public function getAlimentoEliminar($id){
        $alimento = Escuela::findOrFail($id);

        if($alimento->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminación de alimento: '.$alimento->nombre;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Alimento eliminado con exito!.')
                    ->with('typealert', 'warning');
        endif;
    }
}
