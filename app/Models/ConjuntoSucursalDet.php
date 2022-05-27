<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConjuntoSucursalDet extends Model
{
    protected $table ='CONJUNTOS_SUCURSALES_DET';

    public function relacion_conjunto_sucursar(){
        return $this->hasOne(ConjuntoSucursal::class,'CONJUNTO_SUCURSALES_ID','CONJUNTO_SUCURSALES_ID');
    }

    public function relacion_sucursal(){
        return $this->hasOne(Sucursal::class,'SUCURSAL_ID','SUCURSAL_ID');
    }
}
