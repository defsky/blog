<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Admin\AppUserInfo;

class AppManageController extends Controller
{
    //
    public function userlist (Request $request) {
        if ($request->filled('cid')) {
            $cid = $request->cid;    
        }

        if (isset($cid)) {
            if ($cid == 'module') {
                $tplName = 'admin.partial_userlist';    
            } else if ($cid == 'userlist'){
                $tplName = 'admin.partial_userlistpage';    
            }

            if (isset($tplName)) {
                $users = AppUserInfo::paginate(3);
                return view($tplName, compact('users'));
            }
        }
    }

    public function userinfo (Request $request) {
        if ($request->filled('uid')) {
            $uid = $request->uid;

            $user = AppUserInfo::find($uid);

            return view('admin.partial_userinfo',compact('user'));
        }
    }

    public function orderlist () {
        return view('admin.partial_orderlist');
    }
}
