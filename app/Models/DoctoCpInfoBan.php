<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctoCpInfoBan extends Model
{
    
    protected $table = 'DOCTOS_CP_INFO_BAN';

    public function relacion_beneficiario(){
        return $this->hasOne(Beneficiario::class,'BENEFICIARIO_ID','BENEFICIARIO_ID');
    }

    public function relacion_cuenta_bancaria(){
        return $this->hasOne(CuentaBancaria::class,'CUENTA_BAN_ID','CUENTA_BAN_ID');
    }
    
  
    public function relacion_docto_cp(){
        return $this->hasOne(DoctoCP::class,'DOCTO_CP_ID','DOCTO_CP_ID');

}
}
