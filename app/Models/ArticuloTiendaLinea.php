<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticuloTiendaLinea extends Model
{
    

    protected $table = 'ARTICULOS_TIENDA_LINEA';


    public function relacion_articulo(){
        return $this->hasOne(Articulo::class,'ARTICULO_ID','ARTICULO_ID');
    }
}
