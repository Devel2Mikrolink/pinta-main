<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagoNominaVac extends Model
{
    protected $table = 'PAGOS_NOMINA_VAC';

    public function relacion_pago_nomina(){
        return $this->hasOne(PagoNomina::class,'PAGO_NOMINA_ID','PAGO_NOMINA_ID');
    }

    public function relacion_vacaciones(){
        return $this->hasOne(Vacacion::class,'VACACIONES_ID','VACACIONES_ID');
    }
}
