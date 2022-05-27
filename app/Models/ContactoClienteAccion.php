<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactoClienteAccion extends Model
{
    
    
    protected $table = 'CONTACTOS_CLIENTES_ACCIONES';

    public function relacion_contacto_cliente(){
        return $this->hasOne(ContactoCliente::class,'CONTACTO_CLIENTE_ID','CONTACTO_CLIENTE_ID');
    } 

    
    public function relacion_cliente(){
        return $this->hasOne(AccionContactoCliente ::class,'ACCION_ID','ACCION_ID');
    } 
}
