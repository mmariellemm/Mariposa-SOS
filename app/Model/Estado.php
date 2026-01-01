<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estado';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
