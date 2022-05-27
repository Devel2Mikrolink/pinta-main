<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SucursalCatalogoDet extends Model
{
    protected $table ='SUCURSALES_CATALOGOS_DET'; 

    public function relacion_sucursal_catalogo(){
        return $this->hasOne(SucursalCatalogo::class,'SUCURSAL_CATALOGO_ID','SUCURSAL_CATALOGO_ID');
    }
}
