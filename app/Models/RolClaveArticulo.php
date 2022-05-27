<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolClaveArticulo extends Model
{
    protected $primaryKey = "ROL_CLAVE_ART_ID";
    
    protected $table = 'ROLES_CLAVES_ARTICULOS';
}
