<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $table = 'sala';
    protected $primaryKey = 'id_sala';
    public $timestamps = false;
}
