<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrecioArticulo extends Model
{
    protected $table ='PRECIOS_ARTICULOS';

    public function relacion_articulo(){
        return $this->hasOne(Articulo::class,'ARTICULO_ID','ARTICULO_ID');
    }

    public function relacion_moneda(){
        return $this->hasOne(Moneda::class,'MONEDA_ID','MONEDA_ID');
    }

    public function relacion_precio_empresa(){
        return $this->hasOne(PrecioEmpresa::class,'PRECIO_EMPRESA_ID','PRECIO_EMPRESA_ID');
    }
}
