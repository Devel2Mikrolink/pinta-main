<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComiVenCli extends Model
{
    
    protected $table = 'COMIS_VEN_CLI';

    public function relacion_cliente(){
        return $this->hasOne(Cliente::class,'CLIENTE_ID','CLIENTE_ID');
    }

    public function relacion_politica_comision_vendedor(){
        return $this->hasOne(PoliticaComisionVendedor::class,'POLITICA_COMIS_VEN_ID','POLITICA_COMIS_VEN_ID');
    }
}
