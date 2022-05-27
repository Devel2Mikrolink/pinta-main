<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClaveCliente extends Model
{
    
    protected $table = 'CLAVES_CLIENTES';

    public function relacion_cliente(){
        return $this->hasOne(Cliente::class,'CLIENTE_ID','CLIENTE_ID');
    }
}
