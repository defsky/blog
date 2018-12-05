<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use WebAPI;

use App\Models\Admin\GameRoomInfo;
use App\Models\Admin\AppData;

class GameRoomController extends Controller
{
    //
    protected $apiurl;

    public function __construct() {
        $cfg = config('api.gameroom');
        $this->apiurl = 'http://'.$cfg['host'].':'.$cfg['port'].$cfg['path'];
    }

    public function index (Request $request) {
        if ($request->filled('cid')) {
            $cid = $request->cid;    

            if ($cid == 'module') {
                $tplName = 'admin.partial_gameroom';    
            } else if ($cid == 'gameroomlist'){
                $tplName = 'admin.partial_gameroomlist';    
            }

            $rooms = [];
            $kw = '';
            $kwtype = '';
            $roomStatus = GameRoomInfo::ROOM_STATUS;
            $feeTypes = GameRoomInfo::FEE_TYPES;
            $apps = AppData::select('appid','name')->get();

            foreach ($apps as $app) {
                $roomTypes[$app->appid] = $app->name;
            }

            $rooms = GameRoomInfo::orderBy('appid','desc')->paginate(15);

            foreach ($rooms as $room) {
                $room->fee_type = $feeTypes[$room->fee_type];
                $room->appid = $roomTypes[$room->appid];    
            }

            return view($tplName,compact('rooms', 'kw','apps', 'kwtype', 'feeTypes','roomStatus'));    
        }
    }
    public function createroom (Request $request) {
        $data = $request->except(['_token']);
        $data['fun'] = 0;
        $data['count'] = (int)$data['count'];
        $data['fee'] = (double)$data['fee'];
        $data['fee_type'] = (int)$data['fee_type'];
        $data['maxNumber'] = (int)$data['maxNumber'];
        $data['minNumber'] = (int)$data['minNumber'];
        $data['time'] = date('H:i',strtotime($data['time']));

        try {
            $result = WebAPI::post($data, $this->apiurl);
            $result = $result ? $result->Response : (object)[];
        } catch (\Exception $e) {
            $result = (object)[
                'ret'   => 99,
                'msg'   => $e->getMessage(),
                'code'  => $e->getCode()
            ];
        }

        return Response()->json($result);
    }

    public function deleteroom (Request $request) {
        $data = $request->except(['_token']);
        $data['fun'] = 1;

        try {
            $result = WebAPI::post($data, $this->apiurl);
            $result = $result ? $result->Response : (object)[];
        } catch (\Exception $e) {
            $result = (object)[
                'ret'   => 99,
                'msg'   => $e->getMessage(),
                'code'  => $e->getCode()
            ];
        }

        return Response()->json($result);
    }

    public function testapi () {
        $url = 'http://api.tswvc.com/do.php';
        $data = [
            'fun'   => 0,
            'time'  => '19:30:00',
            'appid' => '3',
            'count' => 5,
            'fee'   => 3.0,
            'fee_type'=> 1,
            'maxNumber'=> 150,
            'minNumber'=> 30,
        ];
        
        $data2 = [
            'gameserver'    => 1,
            'accounts'      => [
                [
                    'account'   => 'ccc',
                    'password'  => '111'
                ],
                [
                    'account'   => 'ddd',
                    'password'  => '222'
                ]
            ]
        ];

        return Response()->json(WebAPI::post($data2, $url));
    }
}
