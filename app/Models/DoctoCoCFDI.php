<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctoCoCFDI extends Model
{
    
      
    protected $table = 'DOCTOS_CO_CFDI';

    public function relacion_docto_co(){
        return $this->hasOne(DoctoCo::class,'DOCTO_CO_ID','DOCTO_CO_ID');
    }

    public function relacion_repositorio_cfdi(){
        return $this->hasOne(RepositorioCFDI::class,'CFDI_ID','CFDI_ID');
    }
}
