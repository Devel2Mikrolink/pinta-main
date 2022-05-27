<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoIsn extends Model
{
    protected $table = 'TIPOS_ISN';

    public function relacion_tabla_no(){
        return $this->hasOne( TablaNo::class,'TABLA_NO_ID','TABLA_NO_ID');
    }



   
}
