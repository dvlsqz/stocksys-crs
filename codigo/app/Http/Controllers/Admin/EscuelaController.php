<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Escuela, App\Models\Ubicacion, App\Models\Bitacora;
use Validator, Auth, Hash, Config, Carbon\Carbon;

class EscuelaController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getInicio(){
        $escuelas = Escuela::with(['ubicacion'])->get();

        $datos = [
            'escuelas' => $escuelas
        ];

        return view('admin.escuelas.inicio',$datos);
    }

    public function getEscuelaRegistrar(){
        $escuela = new Escuela;
        $ubicaciones = Ubicacion::with('ubicacion_superior')->where('nivel', 3)->get();

        $datos = [
            'escuela' => $escuela,
            'ubicaciones' => $ubicaciones
        ];

        return view('admin.escuelas.registrar',$datos);
    }

    public function postEscuelaRegistrar(Request $request){
        $reglas = [
            'codigo' => 'required',
    		'nombre' => 'required',
            'direccion' => 'required',
            'id_ubicacion' => 'required',
            'director' => 'required'
    	];
    	$mensajes = [
            'codigo.required' => 'Se requiere un codigo para la escuela.',
    		'nombre.required' => 'Se requiere un nombre para la escuela.',
            'direccion.required' => 'Se requiere una direccion de la escuela.',
            'id_ubicacion.required' => 'Se requiere seleccione la ubicación de la escuela.',
            'director.required' => 'Se requiere el nombre del director de la escuela.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $e = new Escuela;
            $e->codigo = e($request->input('codigo'));
            $e->nombre = e($request->input('nombre'));
            $e->direccion = e($request->input('direccion'));
            $e->id_ubicacion = $request->input('id_ubicacion');            
            $e->director = e($request->input('director'));
            $e->contacto_no1 = e($request->input('contacto_no1'));
            $e->contacto_no2 = e($request->input('contacto_no2'));
            $e->no_preprimaria_tercero = e($request->input('no_preprimaria_tercero'));
            $e->no_cuarto_sexto = e($request->input('no_cuarto_sexto'));
            $e->no_lideres = e($request->input('no_lideres'));
            $e->no_voluntarios = e($request->input('no_voluntarios'));
            $e->observaciones = e($request->input('observaciones'));
            $e->id_socio = Auth::user()->id_institucion;
            $e->estado = '0';


            if($e->save()):

                return redirect('/admin/escuelas')->with('messages', '¡Escuela creada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getEscuelaEditar($id){
        $escuela = Escuela::findOrFail($id);
        $ubicaciones = Ubicacion::where('nivel', 3)->pluck('nombre', 'id');

        $datos = [
            'escuela' => $escuela,
            'ubicaciones' => $ubicaciones
        ];

        return view('admin.escuelas.editar',$datos);
    }

    public function postEscuelaEditar(Request $request, $id){
        $reglas = [
            'codigo' => 'required',
    		'nombre' => 'required',
            'direccion' => 'required',
            'id_ubicacion' => 'required',
            'director' => 'required'
    	];
    	$mensajes = [
            'codigo.required' => 'Se requiere un codigo para la escuela.',
    		'nombre.required' => 'Se requiere un nombre para la escuela.',
            'direccion.required' => 'Se requiere una direccion de la escuela.',
            'id_ubicacion.required' => 'Se requiere seleccione la ubicación de la escuela.',
            'director.required' => 'Se requiere el nombre del director de la escuela.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $e = Escuela::findOrFail($id);
            $e->codigo = e($request->input('codigo'));
            $e->nombre = e($request->input('nombre'));
            $e->direccion = e($request->input('direccion'));
            $e->id_ubicacion = $request->input('id_ubicacion');            
            $e->director = e($request->input('director'));
            $e->contacto_no1 = e($request->input('contacto_no1'));
            $e->contacto_no2 = e($request->input('contacto_no2'));
            $e->no_preprimaria_tercero = e($request->input('no_preprimaria_tercero'));
            $e->no_cuarto_sexto = e($request->input('no_cuarto_sexto'));
            $e->no_lideres = e($request->input('no_lideres'));
            $e->no_voluntarios = e($request->input('no_voluntarios'));
            $e->observaciones = e($request->input('observaciones'));
            $e->estado = '0';

            if($e->save()):

                return redirect('/admin/escuelas')->with('messages', '¡Información actualizada y guardada con exito!.')
                ->with('typealert', 'info');
    		endif;
        endif;
    }

    public function getEscuelaEliminar($id){
        $escuela = Escuela::findOrFail($id);

        if($escuela->delete()):
            return back()->with('messages', '¡Escuela eliminada con exito!.')
                    ->with('typealert', 'warning');
        endif;
    }
}
