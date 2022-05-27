<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrecioCliCli extends Model
{
    
    protected $table = 'PRECIOS_CLI_CLI';

    public function relacion_cliente(){
        return $this->hasOne(Cliente::class,'CLIENTE_ID','CLIENTE_ID');
    }

    
    public function relacion_politica_precio_cliente(){
        return $this->hasOne(PoliticaPrecioCliente::class,'POLITICA_PRECIOS_CLI_ID','POLITICA_PRECIOS_CLI_ID');
    }


    public function relacion_politica_politica_dscto_art(){
        return $this->hasOne(PoliticaDsctoArtCli::class,'POLITICA_DSCTO_ART_CLI_ID','POLITICA_DSCTO_ART_CLI_ID');
    }

  
    public function relacion_precio_empresa(){
        return $this->hasOne(PrecioEmpresa::class,'PRECIO_EMPRESA_ID','PRECIO_EMPRESA_ID');
    }
    


    
}
