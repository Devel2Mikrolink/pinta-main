<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FolioCompra extends Model
{
   protected $table='FOLIOS_COMPRAS'; 

   public function relacion_sucursal(){
    return $this->hasOne(Sucursal::class,'SUCURSAL_ID','SUCURSAL_ID');
}
}
