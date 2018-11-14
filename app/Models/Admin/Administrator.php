<?php

namespace App\Models\Admin;

use Illuminate\Foundation\Auth\User;

class Administrator extends User
{
    //
    protected   $table = 'administrators';
    protected   $primaryKey = 'id';
    protected   $guarded=[];
    public      $timestamps=true;
}
