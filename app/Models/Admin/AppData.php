<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\AppBaseModel;

class AppData extends AppBaseModel
{
    //
    protected $table = 'app_data';
    protected $primaryKey = 'appid';
    protected $guarded = [];
}
