<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacacion extends Model
{
    protected $table = 'VACACIONES';

    public function relacion_empleado(){
        return $this->hasOne(Empleado::class,'EMPLEADO_ID','EMPLEADO_ID');
    }
}
