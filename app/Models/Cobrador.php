<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cobrador extends Model
{
    protected $table = 'COBRADORES';


    public function relacion_politica_cobrador(){
        return $this->hasOne(PoliticaComisionCobrador::class,'POLITICA_COMIS_COB_ID','POLITICA_COMIS_COB_ID');
    }
}
