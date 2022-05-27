<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Impuesto extends Model
{
    protected $primaryKey = "IMPUESTO_ID";
    protected $table ='IMPUESTOS';
    
    public function relacion_tipo_impuesto(){
        return $this->hasOne(TipoImpuesto::class,'TIPO_IMPTO_ID','TIPO_IMPTO_ID');
    } 
}
