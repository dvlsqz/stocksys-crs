<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ruta, App\Models\Ubicacion,App\Models\Escuela, App\Models\Bitacora;
use Validator, Auth, Hash, Config, Carbon\Carbon;

class RutaController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getInicio(){
        $rutas = Ruta::with(['ubicacion'])->get();
        $ruta = new Ruta;
        $ubicaciones = Ubicacion::with('ubicacion_superior')->where('nivel', 3)->get();

        $datos = [
            'rutas' => $rutas,
            'ruta' => $ruta,
            'ubicaciones' => $ubicaciones
        ];

        return view('admin.rutas.inicio',$datos);
    }

    public function postRutaRegistrar(Request $request){
        $reglas = [
            'id_ubicacion' => 'required'
    	];
    	$mensajes = [
            'id_ubicacion.required' => 'Se requiere la ubicacion para la ruta.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $correlativo = Ruta::where('id_ubicacion', $request->input('id_ubicacion'))->count();

            //return $correlativo+1;

            $r = new Ruta;
            $r->correlativo = $correlativo+1;
            $r->id_ubicacion = $request->input('id_ubicacion');
            $r->hora_salida = $request->input('hora_salida');
            $r->observaciones = e($request->input('observaciones'));
            $r->estado = '0';


            if($r->save()):

                return redirect('/admin/rutas')->with('messages', '¡Ruta creada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getRutaAsignarEscuelas($id){
        $ruta = Ruta::findOrFail($id);
        $escuelas = Escuela::where('id_ubicacion', $ruta->id_ubicacion)->get();


        $datos = [
            'ruta' => $ruta,
            'escuelas' => $escuelas
        ];

        return view('admin.rutas.asignar_escuelas',$datos);
    }
}
