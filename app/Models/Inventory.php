<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public function supply(){
        return $this->hasOne(Supply::class,'id','id_supply')->with('measure');
    } 
}
