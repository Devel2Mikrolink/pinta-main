<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagenCliente extends Model
{
    
    protected $table = 'IMAGENES_CLIENTES';
    

    public function relacion_cliente(){
        return $this->hasOne(Cliente::class,'CLIENTE_ID','CLIENTE_ID');
    }
}
