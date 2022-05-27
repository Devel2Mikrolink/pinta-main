<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    
    
    protected $table = 'VENDEDORES';


    public function relacion_politica_comision_vendedor(){
        return $this->hasOne(PoliticaComisionVendedor::class,'POLITICA_COMIS_VEN_ID','POLITICA_COMIS_VEN_ID');
    }
}
