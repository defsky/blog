<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GiftBagController extends Controller
{
    //
    public function index () {
        $bags = [];
        $kw = '';
        $kwtype = '';

        return view('admin.partial_giftbag',compact('bags', 'kw', 'kwtype'));    
    }
}
