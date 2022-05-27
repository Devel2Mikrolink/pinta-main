<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $primaryKey = "ARTICULO_ID";
    protected $table = 'ARTICULOS';


    public function relacion_linea_de_articulos(){
        return $this->hasOne(LineaArticulo::class,'LINEA_ARTICULO_ID','LINEA_ARTICULO_ID');
    } 
}
