<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CapaPedimento extends Model
{
    
    protected $table = 'CAPAS_PEDIMENTOS';


    public function relacion_almacen(){
        return $this->hasOne(Almacen::class,'ALMACEN_ID','ALMACEN_ID');
    } 

    public function relacion_articulo(){
        return $this->hasOne(Articulo::class,'ARTICULO_ID','ARTICULO_ID');
    } 


    public function relacion_art_discreto(){
        return $this->hasOne(ArticuloDiscreto::class,'ART_DISCRETO_ID','ART_DISCRETO_ID');
    } 

    public function relacion_pedimento(){
        return $this->hasOne(Pedimento::class,'PEDIMENTO_ID','PEDIMENTO_ID');
    } 


    
}
