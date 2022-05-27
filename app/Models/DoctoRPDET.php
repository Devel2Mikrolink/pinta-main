<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctoRPDET extends Model
{
    
     
    protected $table = 'DOCTOS_RP_DET';

    public function relacion_doctos_cc(){
        return $this->hasOne(DoctoCC::class,'DOCTO_CC_ID','DOCTO_CC_ID');
    }

    public function relacion_doctos_rp(){
        return $this->hasOne(LugarExpedicion::class,'LUGAR_EXPEDICION_ID','LUGAR_EXPEDICION_ID');
    }

}
