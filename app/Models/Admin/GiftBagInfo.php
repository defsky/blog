<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class GiftBagInfo extends AppBaseModel
{
    //
    const BAG_TYPES = [
        'Original Coin',
        'Activity Value',
        'Activity Coin',
    ];

    const BAG_STATUS = [
        1 => 'Yes',
        0 => 'No',
    ];

    protected $table = 'gift_code';
    protected $primaryKey = 'code';
    protected $keyType = 'string';
    protected $guarded = [];
}
