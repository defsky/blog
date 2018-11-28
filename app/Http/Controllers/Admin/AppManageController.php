<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Admin\AppUserInfo;
use App\Models\Admin\AppOrderInfo;

class AppManageController extends Controller
{
    protected $orderStatus = [
        '初始状态',
        '确认',
        '申诉',
        '补正',
        '客服处理完成'
    ];

    //用户列表
    public function userlist (Request $request) {
        $userKwTypes = [
            'Phone',
            'UUID'
        ];
        $userTableColMap = [
            'phone',
            'uuid'
        ];

        if ($request->filled('cid')) {
            $cid = $request->cid;    

            if ($cid == 'module') {
                $tplName = 'admin.partial_userlist';    
            } else if ($cid == 'userlist'){
                $tplName = 'admin.partial_userlistpage';    
            }

            $users = [];
            $kw = '';
            $kwtype = '';
            if (isset($tplName)) {
                if ($request->filled('kw')) {
                    $kw = $request->kw;
                    $kwtype = $request->kwtype;
                    if (isset($userTableColMap[$kwtype])) {
                        $users = AppUserInfo::whereRaw($userTableColMap[$kwtype].' like ?',[$kw.'%'])->paginate(10); 
                    }
                } else {
                    $users = AppUserInfo::paginate(10);
                }
                return view($tplName, compact('users', 'userKwTypes', 'kw', 'kwtype'));
            }
        }
    }

    //订单列表
    public function orderlist (Request $request) {
        $orderKwTypes = [
            'Phone',
            'UUID',
            'Status'
        ];
        $orderTableColMap = [
            'pay_phone_sell',
            'uuid_sell',
            'appeal_status'
        ];

        if ($request->filled('cid')) {
            $cid = $request->cid;    

            if ($cid == 'module') {
                $tplName = 'admin.partial_orderlist';    
            } else if ($cid == 'orderlist'){
                $tplName = 'admin.partial_orderlistpage';    
            }

            $orders = [];
            $kw = '';
            $kwtype = '';
            if (isset($tplName)) {
                if ($request->filled('kw')) {
                    $kw = $request->kw;
                    $kwtype = $request->kwtype;
                    if (isset($orderTableColMap[$kwtype])) {
                        switch ($orderTableColMap[$kwtype]) {
                            case 'appeal_status':
                                $calculator = ' = ?';
                                $filterValues = [$kw];
                                break;
                            default:    
                                $calculator = ' like ?';
                                $filterValues = [$kw.'%'];
                        }
                        $orders = AppOrderInfo::whereRaw($orderTableColMap[$kwtype].$calculator,$filterValues)->orderBy('appeal_status','asc')->paginate(10); 
                    }
                } else {
                    $orders = AppOrderInfo::paginate(10);
                }

                foreach ($orders as $order) {
                    $order->appeal_status = $this->orderStatus[$order->appeal_status];
                }
                $orderStatus = $this->orderStatus;
                return view($tplName, compact('orders', 'orderKwTypes', 'kw', 'kwtype', 'orderStatus'));
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

    public function orderinfo (Request $request) {
        if ($request->filled('uid')) {
            $uid = $request->uid;

            $order = AppOrderInfo::find($uid);

            return view('admin.partial_orderinfo',['order' => $order, 'orderStatus' => $this->orderStatus]);
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
    public function saveorderinfo (Request $request) {
        if ($request->isMethod('get')) {
            return 'Unauthorized';    
        }

        if ($request->filled('orderid')) {
            $tableColNameMap = [
                'orderstatus'   => 'appeal_status'
            ];

            $formdata = $request->all();

            $uid = $request->orderid;
            $order = AppOrderInfo::find($uid);

            $msg = $uid;
            $needSaveOrderinfo = false;

            foreach ($formdata as $key => $value) {
                if (array_key_exists($key,$tableColNameMap)) {
                    if ($order->{$tableColNameMap[$key]} != $value) {
                        $order->{$tableColNameMap[$key]} = $value;
                        $needSaveOrderinfo = true;
                    }
                }
            }

            if ($needSaveOrderinfo) {
                $order->save();    
            }
            return $msg;
        }
    }
}
