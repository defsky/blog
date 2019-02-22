<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class GameRoomInfo extends ThirdAppBaseModel
{
    //
    const ROOM_STATUS = [
        
    ];
    const FEE_TYPES = [
        'Activity Coin',
        'Original Coin',
        'Activity Value',
    ];

    protected $table = 'app_rooms';
    protected $primaryKey = 'roomid';
    protected $keyType = 'string';
    protected $guarded = [];

}
