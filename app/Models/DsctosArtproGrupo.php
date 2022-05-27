<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DsctosArtproGrupo extends Model
{
    protected $table ='DSCTOS_ARTPRO_GRUPOS';
    public function relacion_grupo_linea(){
        return $this->hasOne(GrupoLinea::class,'GRUPO_LINEA_ID','GRUPO_LINEA_ID');
    }
    public function relacion_politica_precio_prov(){
        return $this->hasOne(PoliticaPrecioProv::class,'POLITICA_PRECIOS_PROV_ID','POLITICA_PRECIOS_PROV_ID');
    }
}
