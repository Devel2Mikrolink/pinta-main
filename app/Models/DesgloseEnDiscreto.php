<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesgloseEnDiscreto extends Model
{
    protected $table = 'DESGLOSE_EN_DISCRETOS';

    public function relacion_articulo_discreto(){
        return $this->hasOne(ArticuloDiscreto::class,'ART_DISCRETO_ID','ART_DISCRETO_ID');
    } 

    public function relacion_docto_in_det(){
        return $this->hasOne(DoctoInDet::class,'DOCTO_IN_DET_ID','DOCTO_IN_DET_ID');
    } 

}
