<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AppOrderData extends Model
{
    //
    protected $table = 'transaction_data';
    protected $primaryKey = 'trade_number';
    protected $guarded = [];

}
