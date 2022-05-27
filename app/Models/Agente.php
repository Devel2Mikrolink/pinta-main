<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agente extends Model
{
    protected $table ='AGENTES';

    
    public function relacion_almacen(){
        return $this->hasOne(Almacen::class,'ALMACEN_ID','ALMACEN_ID');
    } 

    
    public function relacion_cobrador(){
        return $this->hasOne(Cobrador::class,'COBRADOR_ID','COBRADOR_ID');
    } 
    
    public function relacion_concepto_cc(){
        return $this->hasOne(ConceptoCC::class,'CONCEPTO_COBROS_ID','CONCEPTO_COBROS_ID');
    } 
    
    public function relacion_sucursal(){
        return $this->hasOne(SUCURSALES::class,'SUCURSAL_ID','SUCURSAL_ID');
    } 

    
    public function relacion_vendedor(){
        return $this->hasOne(Vendedor::class,'VENDEDOR_ID','VENDEDOR_ID');
    } 
}
