<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubMovtoIn extends Model
{
    protected $primaryKey = "SUB_MOVTO_ID";
    
    protected $table = 'SUB_MOVTOS_IN';
    public function relacion_docto_in_det(){
        return $this->hasOne(Almacen::class,'DOCTO_IN_DET_ID','DOCTO_IN_DET_ID');
    } 
    
}
