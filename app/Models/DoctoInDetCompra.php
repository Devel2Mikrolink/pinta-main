<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctoInDetCompra extends Model
{
    protected $primaryKey = "DOCTOS_IN_DET_COMPRAS";
    protected $table ='DOCTO_IN_DET_ID';

    public function relacion_doctos_in_det(){
        return $this->hasOne(DoctoInDet::class,'DOCTO_IN_DET_ID','DOCTO_IN_DET_ID');
    }
}
