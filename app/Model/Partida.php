<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    protected $table = 'partida';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
