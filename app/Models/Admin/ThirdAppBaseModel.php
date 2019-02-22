<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ThirdAppBaseModel extends Model
{
    protected $connection = 'mysql_thirdapp';
    public $timestamps = false;
}
