<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    protected $table = 'jugador';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
