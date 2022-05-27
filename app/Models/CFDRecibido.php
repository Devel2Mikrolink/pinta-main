<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CFDRecibido extends Model
{
    
    protected $table = 'CFD_RECIBIDOS';
    

    public function relacion_banco(){
        return $this->hasOne(RepositorioCFDI::class,'CFDI_ID','CFDI_ID');
    }
}
