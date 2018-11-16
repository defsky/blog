<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Admin\AppUserInfo;
use App\Models\Admin\AppUserData;

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
        if ($request->isMethod('get')) {
            return 'Unauthorized';    
        }

        if ($request->filled('userid')) {
            $tableColNameMap = [
                'userdata'      => [
                    'creditlevel'   => 'credit',
                    'activitycoin'  => 'activity_coin',
                    'originalcoin'  => 'original_coin'
                ],
                'userinfo'      => [
                    'nickname'      => 'nick_name',
                    'name'          => 'name',
                    'idcardnumber'  => 'identity',
                    'phonenumber'   => 'phone',
                    'alipayid'      => 'pay_phone'
                ]
            ];

            $formdata = $request->all();

            $uid = $request->userid;
            $user = AppUserInfo::find($uid);

            $msg = $user->uuid;
            $needSaveUserinfo = false;
            $needSaveUserdata = false;

            foreach ($formdata as $key => $value) {
                if (array_key_exists($key,$tableColNameMap['userinfo'])) {
                    if ($user->{$tableColNameMap['userinfo'][$key]} != $value) {
                        $user->{$tableColNameMap['userinfo'][$key]} = $value;
                        $needSaveUserinfo = true;
                    }
                }
                if (array_key_exists($key,$tableColNameMap['userdata'])) {
                    if ($user->data->{$tableColNameMap['userdata'][$key]} != $value) {
                        $user->data->{$tableColNameMap['userdata'][$key]} = $value;
                        $needSaveUserdata = true;
                    }
                }
            }

            if ($needSaveUserinfo) {
                $user->save();
            }
            if ($needSaveUserdata) {
                $user->data->save();
            }
            return $msg;    
        }     
    }
}
