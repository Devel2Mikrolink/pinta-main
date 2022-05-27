<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctoIn extends Model
{
    protected $table ='DOCTOS_IN';
    protected $primaryKey = "DOCTO_IN_ID";

    public function relacion_almacen(){
        return $this->hasOne(Almacen::class,'ALMACEN_ID','ALMACEN_ID');
    } 

    public function relacion_capa_costo(){
        return $this->hasOne(CentroCosto::class,'CENTRO_COSTO_ID','CENTRO_COSTO_ID');
    } 

    public function relacion_almacen_destino()
    {
        return $this->hasOne(ALMACEN::class,'ALMACEN_ID','ALMACEN_DESTINO_ID');
    }
    public function relacion_concepto_in(){
        return $this->hasOne(ConceptoIn::class,'CONCEPTO_IN_ID','CONCEPTO_IN_ID');
    } 


    //esta relacion indica que apesar de que en la tabla Docto in no exita un id para unir el docto_in det
    //el padre es docto in 
    //el hijo es docto_in_det
    //y esta funcion relacion dice que el padre no sabe cuantos hijos tine pero los hijos si saben quienes son sus padres
    public function relacion_docto_in_det(){
        return $this->hasMany(DoctoInDet::class,'DOCTO_IN_ID','DOCTO_IN_ID');
    } 

    

}
