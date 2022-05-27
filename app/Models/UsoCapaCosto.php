<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsoCapaCosto extends Model
{
    protected $table = 'USOS_CAPAS_COSTOS';

    public function relacion_capa_costo(){
        return $this->hasOne(CapaCosto::class,'CAPA_ID','CAPA_ID');
    } 

    public function relacion_docto_in_det(){
        return $this->hasOne(DoctoInDet::class,'DOCTO_IN_DET_ID','DOCTO_IN_DET_ID');
    } 
}
