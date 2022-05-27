<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table ='CAJAS';

    
    public function relacion_almacen(){
        return $this->hasOne(Almacen::class,'ALMACEN_ID','ALMACEN_ID');
    } 

    
    public function relacion_forma_cobro(){
        return $this->hasOne(FormaCobro::class,'FORMA_COBRO_ID','FORMA_COBRO_PREDET_ID');
    } 


    
    public function relacion_imagenes_cajas(){
        return $this->hasOne(ImagenCaja::class,'IMAGENES_CAJA_ID','IMAGENES_CAJA_ID');
    } 
}
