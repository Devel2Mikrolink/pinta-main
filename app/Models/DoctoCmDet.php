<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctoCmDet extends Model
{
    protected $table = 'DOCTOS_CM_DET';
    public function relacion_articulo(){
        return $this->hasOne(Articulo::class,'ARTICULO_ID','ARTICULO_ID');
    }
    
    public function relacion_doctos_cm(){
        return $this->hasOne(DoctoCm::class,'DOCTO_CM_ID','DOCTO_CM_ID');
    }
    
}
