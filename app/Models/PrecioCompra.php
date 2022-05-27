<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrecioCompra extends Model
{
protected $table = 'PRECIOS_COMPRA';


public function relacion_articulo(){
    return $this->hasOne(Articulo::class,'ARTICULO_ID','ARTICULO_ID');
} 

public function relacion_proveedor(){
    return $this->hasOne(Provedor::class,'PROVEEDOR_ID','PROVEEDOR_ID');
} 

}
