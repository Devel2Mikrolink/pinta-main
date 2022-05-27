<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DirsCliente extends Model
{
    protected $table = 'DIRS_CLIENTES';
    public function relacion_ciudad(){
        return $this->hasOne(Ciudad::class,'CIUDAD_ID','CIUDAD_ID');
    }
    public function relacion_cliente(){
        return $this->hasOne(Cliente::class,'CLIENTE_ID','CLIENTE_ID');
    }
}
