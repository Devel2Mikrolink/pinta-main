<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrecioProv extends Model
{
    protected $table = 'PRECIOS_PROV';

    
public function relacion_proveedor(){
    return $this->hasOne(Provedor::class,'PROVEEDOR_ID','PROVEEDOR_ID');
}
}
