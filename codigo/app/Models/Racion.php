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
    protected $hidden = ['created_at', 'updated_at'];
}
