<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $primaryKey = "ALMACEN_ID";
    protected $table = 'ALMACENES';
    /**A veces, un modelo puede tener muchos modelos relacionados, pero desea recuperar fácilmente el modelo relacionado 
     * "más reciente" o "más antiguo" de la relación. Por ejemplo, un Usermodelo puede estar relacionado con muchos Ordermodelos, 
     * pero desea definir una forma conveniente de interactuar con el pedido más reciente que
     *  ha realizado el usuario. Puede lograr esto usando el hasOnetipo de relación combinado con los ofManymétodos */
    public function relacion_ciudad(){
        return $this->hasOne(Ciudad::class,'CIUDAD_ID','CIUDAD_ID');
    } 
}
