<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibreCliente extends Model
{
    
    protected $table = 'LIBRES_CLIENTES';
    

    public function relacion_cliente(){
        return $this->hasOne(Cliente::class,'CLIENTE_ID','CLIENTE_ID');
    }
}
