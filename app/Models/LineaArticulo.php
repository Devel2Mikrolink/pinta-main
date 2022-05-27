<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineaArticulo extends Model
{
    protected $primaryKey = "LINEA_ARTICULO_ID";
    protected $table = 'LINEAS_ARTICULOS';

    public function relacion_grupo_linea(){
        return $this->hasOne(GrupoLinea::class,'GRUPO_LINEA_ID','GRUPO_LINEA_ID');
    } 
}
