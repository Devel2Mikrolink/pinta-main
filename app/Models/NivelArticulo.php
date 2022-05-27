<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NivelArticulo extends Model
{
    
    
    protected $table = 'NIVELES_ARTICULOS';


    public function relacion_almacen(){
        return $this->hasOne(Almacen::class,'ALMACEN_ID','ALMACEN_ID');
    }
}
