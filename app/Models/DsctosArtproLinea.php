<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DsctosArtproLinea extends Model
{
    protected $table = 'DSCTOS_ARTPRO_LINEAS';


    public function relacion_linea_articulo(){
        return $this->hasOne(LineaArticulo::class,'LINEA_ARTICULO_ID','LINEA_ARTICULO_ID');
    }

    public function relacion_politica_precio_prov(){
        return $this->hasOne(PoliticaPrecioProv::class,'POLITICA_PRECIOS_PROV_ID','POLITICA_PRECIOS_PROV_ID');
    }
}
