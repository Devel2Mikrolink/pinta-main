<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoliticaPrecioProv extends Model
{
    protected $table = 'POLITICAS_PRECIOS_PROV';
    public function relacion_precio_prov(){
        return $this->hasOne(PrecioProv::class,'PRECIO_PROV_ID','PRECIO_PROV_ID');
    }
    public function relacion_proveedores(){
        return $this->hasOne(Provedor::class,'PROVEEDOR_ID','PROVEEDOR_ID');
    }
}
