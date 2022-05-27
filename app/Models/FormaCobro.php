<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormaCobro extends Model
{
    protected $table ='FORMAS_COBRO';

    
    public function relacion_moneda(){
        return $this->hasOne(Moneda::class,'MONEDA_ID','MONEDA_ID');
    } 
}
