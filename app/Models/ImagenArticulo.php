<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagenArticulo extends Model
{
    

    protected $table = 'IMAGENES_ARTICULOS';


    public function relacion_articulo(){
        return $this->hasOne(Articulo::class,'ARTICULO_ID','ARTICULO_ID');
    }
}
