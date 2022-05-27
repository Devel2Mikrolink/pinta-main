<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    public function inventory(){
        return $this->hasOne(Inventory::class,'id','id_inventory')->with('supply');
    }

    public function supplier(){
        return $this->hasONe(Supplier::class,'id','id_supplier');
    }
}
