<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctoCm extends Model
{
    protected $table ='DOCTOS_CM';

    public function relacion_almacen(){
        return $this->hasOne(Almacen::class,'ALMACEN_ID','ALMACEN_ID');
    }
    
    public function relacion_condiciones_pago_cp(){
        return $this->hasOne(CondicionPagoCp::class,'COND_PAGO_ID','COND_PAGO_ID');
    }

    public function relacion_consignatario_cm(){
        return $this->hasOne(ConsisnatarioCm::class,'CONSIG_CM_ID','CONSIG_CM_ID');
    }

    public function relacion_impuesto_sustituido(){
        return $this->hasOne(Impuesto::class,'IMPUESTO_ID','IMPUESTO_SUSTITUIDO_ID');
    }

    public function relacion_moneda(){
        return $this->hasOne(Moneda::class,'MONEDA_ID','MONEDA_ID');
    }

    public function relacion_pedimento(){
        return $this->hasOne(Pedimento::class,'PEDIMENTO_ID','PEDIMENTO_ID');
    }

    public function relacion_provedor(){
        return $this->hasOne(Provedor::class,'PROVEEDOR_ID','PROVEEDOR_ID');
    }

    public function relacion_via_embarque(){
        return $this->hasOne(ViaEmbarque::class,'VIA_EMBARQUE_ID','VIA_EMBARQUE_ID');
    }
}
