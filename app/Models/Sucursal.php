<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table='SUCURSALES';

    public function relacion_ciudad(){
        return $this->hasOne(Ciudad::class,'CIUDAD_ID','CIUDAD_ID');
    }

    public function relacion_lugar_expedicion(){
        return $this->hasOne(LugarExpedicion::class,'LUGAR_EXPEDICION_ID','LUGAR_EXPEDICION_ID');
    }
}
