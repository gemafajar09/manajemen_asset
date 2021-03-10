<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class getUserModel extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'getUser_uke';
}
