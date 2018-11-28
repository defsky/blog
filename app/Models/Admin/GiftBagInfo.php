<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class GiftBagInfo extends AppBaseModel
{
    //
    protected $table = 'gift_code';
    protected $primaryKey = 'code';
    protected $keyType = 'string';
    protected $guarded = [];
}
