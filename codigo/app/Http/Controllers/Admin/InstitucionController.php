<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Institucion, App\Models\Ubicacion;
use Validator, Auth, Hash, Config, Carbon\Carbon;

class InstitucionController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getInicio(){
        $instituciones = Institucion::all();

        $datos = [
            'instituciones' => $instituciones
        ];

        return view('admin.instituciones.inicio',$datos);
    }

    public function getInstitucionRegistrar(){
        $institucion = new Institucion;
        $ubicaciones = Ubicacion::where('nivel', 3)->pluck('nombre', 'id');

        $datos = [
            'institucion' => $institucion,
            'ubicaciones' => $ubicaciones
        ];

        return view('admin.instituciones.registrar',$datos);
    }

    public function postInstitucionRegistrar(Request $request){
        $reglas = [
    		'nombre' => 'required',
            'direccion' => 'required',
            'nivel' => 'required',
            'id_ubicacion' => 'required'
    	];
    	$mensajes = [
    		'nombre.required' => 'Se requiere un nombre para la institución.',
            'direccion.required' => 'Se requiere una direccion de la institución.',
            'nivel.required' => 'Se requiere seleccione el tipo o nivel de la institución.',
            'id_ubicacion.required' => 'Se requiere seleccione la ubicación de la institución.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $i = new Institucion;
            $i->nombre = e($request->input('nombre'));
            $i->direccion = e($request->input('direccion'));
            $i->nivel = $request->input('nivel');
            $i->id_ubicacion = $request->input('id_ubicacion');
            $i->encargado = e($request->input('encargado'));
            $i->contacto = e($request->input('contacto'));
            $i->correo = e($request->input('correo'));
            $i->observaciones = e($request->input('observaciones'));
            $i->estado = '0';


            if($i->save()):

                return redirect('/admin/instituciones')->with('messages', '¡Institución creada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getInstitucionEditar($id){
        $institucion = Institucion::findOrFail($id);
        $ubicaciones = Ubicacion::where('nivel', 3)->pluck('nombre', 'id');

        $datos = [
            'institucion' => $institucion,
            'ubicaciones' => $ubicaciones
        ];

        return view('admin.instituciones.editar',$datos);
    }

    public function postInstitucionEditar(Request $request, $id){
        $reglas = [
    		'nombre' => 'required',
            'direccion' => 'required',
            'nivel' => 'required',
            'id_ubicacion' => 'required'
    	];
    	$mensajes = [
    		'nombre.required' => 'Se requiere un nombre para la institución.',
            'direccion.required' => 'Se requiere una direccion de la institución.',
            'nivel.required' => 'Se requiere seleccione el tipo o nivel de la institución.',
            'id_ubicacion.required' => 'Se requiere seleccione la ubicación de la institución.'
    	];
        
        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $i = Institucion::findOrFail($id);
            $i->nombre = e($request->input('nombre'));
            $i->direccion = e($request->input('direccion'));
            $i->nivel = $request->input('nivel');
            $i->id_ubicacion = $request->input('id_ubicacion');
            $i->encargado = e($request->input('encargado'));
            $i->contacto = e($request->input('contacto'));
            $i->correo = e($request->input('correo'));
            $i->observaciones = e($request->input('observaciones'));
            $i->estado = '0';


            if($i->save()):

                return redirect('/admin/instituciones')->with('messages', '¡Información actualizada y guardada con exito!.')
                    ->with('typealert', 'info');
    		endif;
        endif;
    }

    

    public function getInstitucionEliminar($id){
        $institucion = Institucion::findOrFail($id);

        if($institucion->delete()):
            return back()->with('messages', '¡Institución eliminada con exito!.')
                    ->with('typealert', 'warning');
        endif;
    }

}
