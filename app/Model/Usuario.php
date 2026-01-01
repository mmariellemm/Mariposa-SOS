<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as authenticable;

class Usuario extends Authenticable
{
    protected $table = 'usuario';
    protected $primaryKey = 'id';
    public $timestamps = false;
}