<?php

namespace App\Models\Admin;

class AppUserData extends AppBaseModel
{
    //
    protected $table = "user_data";
    protected $primaryKey = "uuid";
    protected $guarded = [];

    public function user () {
        return $this->belongsTo('App\Models\Admin\AppUserInfo','uuid','uuid');    
    }
}
