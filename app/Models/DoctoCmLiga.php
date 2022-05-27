<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctoCmLiga extends Model
{
    protected $table ='DOCTOS_CM_LIGAS';

    public function relacion_docto_cm_dest(){
        return $this->hasOne(DoctoCm::class,'DOCTO_CM_ID','DOCTO_CM_DEST_ID');
    }
    
    public function relacion_docto_cm_fte(){
        return $this->hasOne(Impuesto::class,'DOCTO_CM_ID','DOCTO_CM_FTE_ID');
    }
}
