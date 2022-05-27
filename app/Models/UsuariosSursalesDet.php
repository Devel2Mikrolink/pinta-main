<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuariosSursalesDet extends Model
{
    protected $table ='USUARIOS_SUCURSALES_DET';
    public function relacion_sucursal(){
        return $this->hasOne(Sucursal::class,'SUCURSAL_ID','SUCURSAL_ID');
    }
    public function relacion_usuario_sucursal(){
        return $this->hasOne(UsuarioSucursal::class,'USUARIO_SUCURSAL_ID','USUARIO_SUCURSAL_ID');
    }
}
