<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $hidden = ['created_at', 'updated_at'];

    public function institucion(){
        return $this->hasOne(institucion::class,'id','id_institucion');
    }
}
