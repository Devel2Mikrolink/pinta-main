<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConceptoBa extends Model
{

            
    protected $table = 'CONCEPTOS_BA';

    public function relacion_tipo_poliza(){
        return $this->hasOne(TipoPoliza::class,'TIPO_POLIZA_ID','TIPO_POLIZA_ID');
    }

}
