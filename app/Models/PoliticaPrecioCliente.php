<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoliticaPrecioCliente extends Model
{
 
    protected $table = 'POLITICAS_PRECIOS_CLIENTES';

    
    public function relacion_cliente(){
        return $this->hasOne(Cliente::class,'CLIENTE_ID','CLIENTE_ID');
    }

    
    public function relacion_politica_desc_art_cli(){
        return $this->hasOne(PoliticaDsctoArtCli::class,'POLITICA_DSCTO_ART_CLI_ID','POLITICA_DSCTO_ART_CLI_ID');
    }

    
    public function relacion_precio_empresa(){
        return $this->hasOne(PrecioEmpresa::class,'PRECIO_EMPRESA_ID','PRECIO_EMPRESA_ID');
    }
}
