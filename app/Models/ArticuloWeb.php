<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticuloWeb extends Model
{
    
    protected $table = 'ARTICULOS_WEB';


    public function relacion_articulo(){
        return $this->hasOne(Articulo::class,'ARTICULO_ID','ARTICULO_ID');
    }
}
