<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ubicacion, App\Models\Bitacora;
use Validator, Auth, Hash, Config, Carbon\Carbon;

class UbicacionController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }
    
    public function getInicio(){
        $ubicaciones = Ubicacion::where('nivel', 1)->get();

        $datos = [
            'ubicaciones' => $ubicaciones
        ];

        return view('admin.ubicaciones.inicio',$datos);
    }

    public function postUbicacionRegistrar(Request $request){
        $reglas = [
    		'nombre' => 'required'
    	];
    	$mensajes = [
    		'nombre.required' => 'Se requiere un nombre para la ubicación.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $u = new Ubicacion;
            $u->nombre = e($request->input('nombre'));
            $u->nivel = $request->input('nivel');

            if($u->save()):
                $b = new Bitacora;
                $b->accion = "Creación de ubicación ".$u->nombre;
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Ubicación creada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getUbicacionListadoN1($id){
        $ubicacion_principal = Ubicacion::findOrFail($id);
        $ubicaciones_n1 = Ubicacion::where('id_principal', $id)->get();
        $id = $id;

        $datos = [
            'ubicacion_principal' => $ubicacion_principal,
            'ubicaciones_n1' => $ubicaciones_n1,
            'id' => $id
        ]; 

        return view('admin.ubicaciones.nivel1', $datos);
    }

    public function postUbicacionN1Registrar(Request $request){
        $reglas = [
    		'nombre' => 'required'
    	];
    	$mensajes = [
    		'nombre.required' => 'Se requiere un nombre para la ubicación.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $u = new Ubicacion;
            $u->nombre = e($request->input('nombre'));
            $u->nivel = $request->input('nivel');
            $u->id_principal = $request->input('id_principal');

            if($u->save()):

                return back()->with('messages', '¡Ubicación Nivel 1 creada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getUbicacionListadoN2($id){
        $ubicacion_principal_n1 = Ubicacion::findOrFail($id);
        $ubicaciones_n2 = Ubicacion::where('id_principal', $id)->get();
        $id = $id;

        $datos = [
            'ubicacion_principal_n1' => $ubicacion_principal_n1,
            'ubicaciones_n2' => $ubicaciones_n2,
            'id' => $id
        ]; 

        return view('admin.ubicaciones.nivel2', $datos);
    }

    public function postUbicacionN2Registrar(Request $request){
        $reglas = [
    		'nombre' => 'required'
    	];
    	$mensajes = [
    		'nombre.required' => 'Se requiere un nombre para la ubicación.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $u = new Ubicacion;
            $u->nombre = e($request->input('nombre'));
            $u->nivel = $request->input('nivel');
            $u->id_principal = $request->input('id_principal');

            if($u->save()):

                return back()->with('messages', '¡Ubicación Nivel 2 creada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getUbicacionEditar($id){
        $ubicacion = Ubicacion::findOrFail($id);

        $datos = [
            'ubicacion' => $ubicacion
        ]; 

        return view('admin.ubicaciones.editar', $datos);
    }

    public function postUbicacionEditar(Request $request, $id){
        $reglas = [
    		'nombre' => 'required'
    	];
    	$mensajes = [
    		'nombre.required' => 'Se requiere un nombre para la ubicación.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $ubicacion = Ubicacion::findOrFail($id);
            $ubicacion->nombre = e($request->input('nombre'));

            if($ubicacion->save()):

                return back()->with('messages', '¡Información actualizada y guardada con exito!.')
                    ->with('typealert', 'info');
    		endif;
        endif;
    }

    public function getUbicacionEliminar($id){
        $ubicacion = Ubicacion::findOrFail($id);

        if($ubicacion->delete()):
            return back()->with('messages', '¡Ubicación eliminada con exito!.')
                    ->with('typealert', 'warning');
        endif;
    }
    
}
