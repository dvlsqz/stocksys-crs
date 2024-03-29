<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Racion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'raciones';
    protected $fillable = [
        'nombre',
        'tipo_alimentos',
        'asignado_a',
        'tipo_bodega',
        'id_institucion'
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function alimentos(){
        return $this->hasMany(AlimentoRacion::class,'id_racion','id');
    }


}
