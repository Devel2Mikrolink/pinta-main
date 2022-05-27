<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctoRP extends Model
{
    
    protected $table = 'DOCTOS_RP';

    public function relacion_cliente(){
        return $this->hasOne(Cliente::class,'CLIENTE_ID','CLIENTE_ID');
    }

    public function relacion_lugares_expedicion(){
        return $this->hasOne(DoctoRP::class,'DOCTO_RP_ID','DOCTO_RP_ID');
    }


    
}
