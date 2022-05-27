<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LugarExpedicion extends Model
{
    protected $primaryKey = "LUGAR_EXPEDICION_ID";
    protected $table = 'LUGARES_EXPEDICION';
    public function relacion_ciudad(){
        return $this->hasOne(Ciudad::class,'CIUDAD_ID','CIUDAD_ID');
    }
}
