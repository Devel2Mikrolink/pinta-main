<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TablaNo extends Model
{
    protected $table ='TABLAS_NO';

    public function relacion_tipo_tabla_no(){
        return $this->hasOne(TipoTablaNo::class,'TIPO_TABLA_NO_ID','TIPO_TABLA_NO_ID');
    }
}
