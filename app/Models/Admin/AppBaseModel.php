<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AppBaseModel extends Model
{
    //
    protected $connection = 'mysql_app';
    public $timestamps = false;
}
