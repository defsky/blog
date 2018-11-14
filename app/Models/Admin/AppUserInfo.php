<?php

namespace App\Models\Admin;

class AppUserInfo extends AppBaseModel
{
    //
    protected $table = 'user_info';
    protected $primaryKey = 'number';
    protected $guarded = [];

    public function data () {
        return $this->hasOne('App\Models\Admin\AppUserData','uuid','uuid');
    }
}
