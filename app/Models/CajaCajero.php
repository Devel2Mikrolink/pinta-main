<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CajaCajero extends Model
{
    protected $table ='CAJAS_CAJEROS';

    
    public function relacion_caja(){
        return $this->hasOne(Caja::class,'CAJA_ID','CAJA_ID');
    } 

    
    public function relacion_cajero(){
        return $this->hasOne(Cajero::class,'CAJERO_ID','CAJERO_ID');
    } 
}
