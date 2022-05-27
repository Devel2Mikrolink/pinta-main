<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImpuestoDoctoCm extends Model
{
    protected $table ='IMPUESTOS_DOCTOS_CM';

    public function relacion_docto_cm(){
        return $this->hasOne(DoctoCm::class,'DOCTO_CM_ID','DOCTO_CM_ID');
    }
    
    public function relacion_impuesto(){
        return $this->hasOne(Impuesto::class,'IMPUESTO_ID','IMPUESTO_ID');
    }
}
