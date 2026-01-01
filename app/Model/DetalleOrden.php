<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DetalleOrden extends Model
{
    protected $table = 'detalle_orden';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
