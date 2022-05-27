<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    protected $fillable = [
        'name',
        'id_measure'
    ];

    public function measure(){
        return $this->hasOne(Measure::class,'id','id_measure');
    }
}
