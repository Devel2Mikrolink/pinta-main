<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConceptoNo extends Model
{
    protected $table ='CONCEPTOS_NO';

    public function relacion_tabla_no(){
        return $this->hasOne(TablaNo::class,'TABLA_NO_ID','TABLA_NO_ID');
    }
}
