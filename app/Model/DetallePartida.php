<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DetallePartida extends Model
{
    protected $table = 'detalle_partida';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
