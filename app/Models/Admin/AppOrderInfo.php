<?php

namespace App\Models\Admin;

class AppOrderInfo extends AppBaseModel
{
    //
    protected $table = 'transaction_record';
    protected $primaryKey = 'trade_number';
    protected $guarded = [];

}
