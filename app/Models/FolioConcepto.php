<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FolioConcepto extends Model
{
    
    protected $primaryKey = "FOLIO_CONCEPTO_ID";
    protected $table='FOLIOS_CONCEPTOS';
    public function relacion_sucursal(){
        return $this->hasOne(Sucursal::class,'SUCURSAL_ID','SUCURSAL_ID');
    }
}
