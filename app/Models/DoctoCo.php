<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctoCo extends Model
{
    
      
    protected $table = 'DOCTOS_CO';

    public function relacion_cliente(){
        return $this->hasOne(GrupoPolizaPeriodCo::class,'GRUPO_POL_PERIOD_ID','GRUPO_POL_PERIOD_ID');
    }
    
    public function relacion_moneda(){
        return $this->hasOne(Moneda::class,'MONEDA_ID','MONEDA_ID');
    }

    public function relacion_lugares_expedicion(){
        return $this->hasOne(TipoPoliza::class,'TIPO_POLIZA_ID','TIPO_POLIZA_ID');
    }


}
