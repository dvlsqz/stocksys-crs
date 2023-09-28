<?php

namespace App\Imports;

use App\Models\Escuela;
use Maatwebsite\Excel\Concerns\ToModel;

class EscuelasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Escuela([
            'codigo'     => $row[0],
            'nombre'    => $row[1], 
            'direccion' => $row[2],
            'id_ubicacion' => $row[3], 
            'director' => $row[4],            
        ]);
    }
}
