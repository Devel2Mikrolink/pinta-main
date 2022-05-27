<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagoNominaCancelado extends Model
{
    protected $table = 'PAGOS_NOMINA_CANCELADOS';
    public function relacion_empleado(){
        return $this->hasOne(Empleado::class,'EMPLEADO_ID','EMPLEADO_ID');
    }
    public function relacion_frecuencia_pago(){
        return $this->hasOne(FrecuenciaPago::class,'FREPAG_ID','FREPAG_ID');
    }
}
