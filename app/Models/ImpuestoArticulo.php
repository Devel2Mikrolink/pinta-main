<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImpuestoArticulo extends Model
{
    protected $table = 'IMPUESTOS_ARTICULOS';

    public function relacion_articulo(){
        return $this->hasOne(Articulo::class,'ARTICULO_ID','ARTICULO_ID');
    } 
    public function relacion_conjunto_sucursal(){
        return $this->hasOne(ConjuntoSucursal::class,'CONJUNTO_SUCURSALES_ID','CONJUNTO_SUCURSALES_ID');
    } 
    public function relacion_impuesto(){
        return $this->hasOne(Impuesto::class,'IMPUESTO_ID','IMPUESTO_ID');
    } 
}
