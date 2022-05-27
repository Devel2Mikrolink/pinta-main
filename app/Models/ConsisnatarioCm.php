<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsisnatarioCm extends Model
{
    protected $table ='CONSIGNATARIOS_CM';

    public function relacion_ciudad(){
        return $this->hasOne(Ciudad::class,'CIUDAD_ID','CIUDAD_ID');
    }
    
    public function relacion_estado(){
        return $this->hasOne(Estado::class,'ESTADO_ID','ESTADO_ID');
    }

    public function relacion_pais(){
        return $this->hasOne(Pais::class,'PAIS_ID','PAIS_ID');
    }
}
