<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactoCliente extends Model
{
    
    
    protected $table = 'CONTACTOS_CLIENTES';

    public function relacion_cliente(){
        return $this->hasOne(Cliente::class,'CLIENTE_ID','CLIENTE_ID');
    } 
}
