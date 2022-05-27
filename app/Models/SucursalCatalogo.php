<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SucursalCatalogo extends Model
{
        protected $table='SUCURSALES_CATALOGOS';
    public function relacion_sucursal(){
    return $this->hasOne(Sucursal::class,'SUCURSAL_ID','SUCURSAL_ID');
}
}
