<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrecioCompraDet extends Model
{
    protected $table = 'PRECIOS_COMPRA_DET';

    public function relacion_moneda(){
        return $this->hasOne(Moneda::class,'PROVEEDOR_ID','PROVEEDOR_ID');
    }

    public function relacion_precio_compra(){
        return $this->hasOne(PrecioCompra::class,'PRECIO_COMPRA_ID','PRECIO_COMPRA_ID');
    }

    public function relacion_precio_prov(){
        return $this->hasOne(PrecioProv::class,'PRECIO_PROV_ID','PRECIO_PROV_ID');
    }
}
