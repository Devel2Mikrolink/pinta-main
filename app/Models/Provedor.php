<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provedor extends Model
{
    protected $primaryKey = "PROVEEDOR_ID";
    protected $table = 'PROVEEDORES';

    public function relacion_ciudad(){
        return $this->hasOne(Ciudad::class,'CIUDAD_ID','CIUDAD_ID');
    }


    public function relacion_concepto_ba(){
        return $this->hasOne(ConceptoBa::class,'CONCEPTO_BA_ID','CONCEPTO_BA_ID');
    }

    public function relacion_condicion_pago(){
        return $this->hasOne(CondicionPago::class,'COND_PAGO_ID','COND_PAGO_ID');
    }

    public function relacion_moneda(){
        return $this->hasOne(Moneda::class,'MONEDA_ID','MONEDA_ID');
    }

       


    public function relacion_tipo_prov(){
        return $this->hasOne(TipoProv::class,'TIPO_PROV_ID','TIPO_PROV_ID');
    }

    public function relacion_via_embarque(){
        return $this->hasOne(ViaEmbarque::class,'VIA_EMBARQUE_ID','VIA_EMBARQUE_ID');
    }
}
