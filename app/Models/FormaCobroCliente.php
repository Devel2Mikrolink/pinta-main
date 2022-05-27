<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormaCobroCliente extends Model
{
    
    protected $table = 'FORMAS_COBRO_CLIENTES';
    

    public function relacion_cliente(){
        return $this->hasOne(Cliente::class,'CLIENTE_ID','CLIENTE_ID');
    }

    
    public function relacion_banco(){
        return $this->hasOne(Banco::class,'BANCO_ID','BANCO_ID');
    }

    
}
