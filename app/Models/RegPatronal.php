<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegPatronal extends Model
{
    protected $table = 'REG_PATRONALES';

    public function relacion_ciudad(){
        return $this->hasOne(Ciudad::class,'CIUDAD_ID','CIUDAD_ID');
    }

    public function relacion_tipo_isn(){
        return $this->hasOne(TipoIsn::class,'TIPO_ISN_ID','TIPO_ISN_ID');
    }
}
