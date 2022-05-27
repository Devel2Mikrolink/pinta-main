<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnticipoCC extends Model
{
    
    
    protected $table = 'ANTICIPOS_CC';
    

    public function relacion_cliente(){
        return $this->hasOne(Cliente::class,'CLIENTE_ID','CLIENTE_ID');
    }
}
