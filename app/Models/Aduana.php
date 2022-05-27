<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aduana extends Model
{
    protected $table = 'ADUANAS';

    public function relacion_ciudad(){
        return $this->hasOne(Ciudad::class,'CIUDAD_ID','CIUDAD_ID');
    } 
}
