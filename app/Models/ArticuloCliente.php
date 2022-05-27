<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticuloCliente extends Model
{
    
    protected $table = 'ARTICULOS_CLIENTES';


    public function relacion_articulo(){
        return $this->hasOne(Articulo::class,'ARTICULO_ID','ARTICULO_ID');
    }


    public function relacion_cliente(){
        return $this->hasOne(Cliente::class,'CLIENTE_ID','CLIENTE_ID');
    }
}
