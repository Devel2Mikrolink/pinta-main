<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClaveArticulo extends Model
{
    protected $primaryKey = "CLAVE_ARTICULO_ID";
    protected $table = 'CLAVES_ARTICULOS';


    public function relacion_articulos(){
        return $this->hasOne(Articulo::class,'ARTICULO_ID','ARTICULO_ID');
    } 
}
