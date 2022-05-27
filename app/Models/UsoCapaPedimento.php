<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsoCapaPedimento extends Model
{
    protected $primaryKey = "CAPA_PEDIMENTO_ID";
    
    protected $table = 'USOS_CAPAS_PEDIMENTOS';
    public function relacion_capa_pedimento(){
        return $this->hasOne(CapaPedimento::class,'CAPA_PEDIMENTO_ID','CAPA_PEDIMENTO_ID');
    } 

    public function relacion_docto_in_det(){
        return $this->hasOne(DoctoInDet::class,'DOCTO_IN_DET_ID','DOCTO_IN_DET_ID');
    } 
}
