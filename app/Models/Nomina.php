<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
    protected $table ='NOMINAS';
    public function relacion_frecuencia_pago(){
        return $this->hasOne(FrecuenciaPago::class,'FREPAG_ID','FREPAG_ID');
    }
}
