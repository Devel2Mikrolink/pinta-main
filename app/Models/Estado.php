<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $primaryKey = "ESTADO_ID";
    protected $table = 'ESTADOS';

    public function relacion_pais(){
        return $this->hasOne(Pais::class,'PAIS_ID','PAIS_ID');
    } 
}
