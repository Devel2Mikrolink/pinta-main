<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SucursalDesconectada extends Model
{
    
    protected $table = 'SUCURSALES_DESCONECTADAS';


    public function relacion_sucursal(){
        return $this->hasOne(Sucursal::class,'SUCURSAL_ID','SUCURSAL_ID');
    }
}
