<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FolioVenta extends Model
{protected $table='FOLIOS_VENTAS'; 

   public function relacion_sucursal(){
    return $this->hasOne(Sucursal::class,'SUCURSAL_ID','SUCURSAL_ID');
}
}
