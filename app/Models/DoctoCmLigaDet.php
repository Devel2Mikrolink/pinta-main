<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctoCmLigaDet extends Model
{
    protected $table ='DOCTOS_CM_LIGAS_DET';
  
    public function relacion_docto_cm_det_dest(){
        return $this->hasOne(DoctoCmDet::class,'DOCTO_CM_DET_ID','DOCTO_CM_DET_DEST_ID');
    }
    public function relacion_docto_cm_det_fte(){
        return $this->hasOne(DoctoCmDet::class,'DOCTO_CM_DET_ID','DOCTO_CM_DET_FTE_ID');
    }
    public function relacion_docto_cm_liga(){
        return $this->hasOne(DoctoCmLiga::class,'DOCTO_CM_LIGA_ID','DOCTO_CM_LIGA_ID');
    }
    
    
}
