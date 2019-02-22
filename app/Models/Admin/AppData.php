<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\AppBaseModel;

class AppData extends ThirdAppBaseModel
{
    //
    protected $table = 'app_data';
    protected $primaryKey = 'appid';
    protected $guarded = [];
}
