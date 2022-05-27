<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedimento extends Model
{
    protected $table = 'PEDIMENTOS';

    public function relacion_aduana(){
        return $this->hasOne(Aduana::class,'ADUANA_ID','ADUANA_ID');
    } 
}
