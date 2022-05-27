<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctoInDet extends Model
{

    protected $table = 'DOCTOS_IN_DET';
    protected $primaryKey = "DOCTO_IN_DET_ID";

    public function relacion_almacen(){
        return $this->hasOne(Almacen::class,'ALMACEN_ID','ALMACEN_ID');
    } 

    public function relacion_articulo(){
        return $this->hasOne(Articulo::class,'ARTICULO_ID','ARTICULO_ID');
    } 

    public function relacion_centro_costo(){
        return $this->hasOne(CentroCosto::class,'CENTRO_COSTO_ID','CENTRO_COSTO_ID');
    } 

    
    public function relacion_concepto_in(){
        return $this->hasOne(ConceptoIn::class,'CONCEPTO_IN_ID','CONCEPTO_IN_ID');
    } 
    
        
    public function relacion_docto_in(){
        return $this->hasOne(DoctoIn::class,'DOCTO_IN_ID','DOCTO_IN_ID');
    } 
}
