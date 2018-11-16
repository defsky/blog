<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Admin\AppUserInfo;

class AppManageController extends Controller
{
    //用户列表
    public function userlist (Request $request) {

        if ($request->filled('cid')) {
            $cid = $request->cid;    

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

    //订单列表
    public function orderlist () {
        return view('admin.partial_orderlist');
    }

    public function userinfo (Request $request) {
        if ($request->filled('uid')) {
            $uid = $request->uid;

            $user = AppUserInfo::find($uid);

            return view('admin.partial_userinfo',compact('user'));
        }
    }

    public function saveuserinfo (Request $request) {
        if ($request->filled('userid')) {
            $tableColNameMap = [
                'nickname'      => 'nick_name',
                'name'          => 'name',
                'idcardnumber'  => 'identity',
                'phonenumber'   => 'phone',
                'alipayid'      => 'pay_phone',
                'creditlevel'   => 'data->credit',
                'activitycoin'  => 'data->activity_coin',
                'originalcoin'  => 'data->original_coin'
            ];
            $formdata = $request->all();

            $uid = $request->userid;
            $user = AppUserInfo::find($uid);

            $msg = $user->uuid;
            $needSave = false;

            foreach ($formdata as $key => $value) {
                if (array_key_exists($key,$tableColNameMap)) {
                    if ($user->{$tableColNameMap[$key]} != $value) {
                        $needSave = true;
                        $user->{$tableColNameMap[$key]} = $value;
                    }
                }
            }

            if ($needSave) {
                $user->save();
            }
                return $msg;    
        }     
    }
}
