<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Admin\AppUserInfo;

class AppManageController extends Controller
{
    //
    public function userlist (Request $request) {
        $users = AppUserInfo::paginate(1)->withPath('admin/userlistpage');


        return view('admin.partial_userlist', compact('users'));
    }

    public function userlistpage (Request $request) {
        $users = AppUserInfo::paginate(1)->withPath('admin/userlistpage');

        return view('admin.partial_userlistpage',compact('users'));
    }

    public function orderlist () {
        return view('admin.partial_orderlist');
    }
}
