<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $primaryKey = "CIUDAD_ID";
    protected $table = 'CIUDADES';

    public function relacion_estado(){
        return $this->hasOne(Estado::class,'ESTADO_ID','ESTADO_ID');
    } 
}
