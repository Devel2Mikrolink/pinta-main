<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DsctosArtproArts extends Model
{
    protected $table = 'DSCTOS_ARTPRO_ARTS';
    public function relacion_articulo(){
        return $this->hasOne(Articulo::class,'ARTICULO_ID','ARTICULO_ID');
    }
    public function relacion_politica_precio_prov(){
        return $this->hasOne(PoliticaPrecioProv::class,'POLITICA_PRECIOS_PROV_ID','POLITICA_PRECIOS_PROV_ID');
    }
}
