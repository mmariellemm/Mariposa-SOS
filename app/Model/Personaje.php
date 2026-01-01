<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Personaje extends Model
{
    protected $table = 'personaje';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
