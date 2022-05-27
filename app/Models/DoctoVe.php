<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctoVe extends Model
{
    protected $table = 'DOCTOS_VE';


    public function relacion_almacen(){
        return $this->hasOne(Almacen::class,'ALMACEN_ID','ALMACEN_ID');
    }

    public function relacion_cliente(){
        return $this->hasOne(Cliente::class,'CLIENTE_ID','CLIENTE_ID');
    }

    public function relacion_condicion_pago(){
        return $this->hasOne(CondicionPago::class,'COND_PAGO_ID','COND_PAGO_ID');
    }

    public function relacion_dir_cliente_cli(){
        return $this->hasOne(DirsCliente::class,'DIR_CLI_ID','DIR_CLI_ID');
    }


    public function relacion_dir_cliente_consig(){
        return $this->hasOne(DirsCliente::class,'DIR_CLI_ID','DIR_CONSIG_ID');
    }
    public function relacion_impuesto_sustituido(){
        return $this->hasOne(Impuesto::class,'IMPUESTO_ID','IMPUESTO_SUSTITUIDO_ID');
    }

    public function relacion_moneda(){
        return $this->hasOne(Moneda::class,'MONEDA_ID','MONEDA_ID');
    }

    public function relacion_repositorrio_cfdi(){
        return $this->hasOne(RepositorioCFDI::class,'CFDI_ID','CFDI_FACT_DEVUELTA_ID');
    }

    public function relacion_vendedor(){
        return $this->hasOne(Vendedor::class,'VENDEDOR_ID','VENDEDOR_ID');
    }

    public function relacion_via_embarque(){
        return $this->hasOne(ViaEmbarque::class,'VIA_EMBARQUE_ID','VIA_EMBARQUE_ID');
    }
    


}
