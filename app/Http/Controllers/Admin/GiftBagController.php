<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\GiftBagInfo;

class GiftBagController extends Controller
{
    //
    protected static $giftbagApiUrl;

    protected static $bagTypes = [
        'Activity Coin',
        'Original Coin',
        'Activity Value'
    ];
    protected static $bagStatus = [
        1 => 'Yes',
        0 => 'No'
    ];
    
    public function __construct () {
        $api_config = config('api.giftbag');
        self::$giftbagApiUrl = 'http://'.$api_config['host'].':'.$api_config['port'].$api_config['path'];    
    }

    public function index (Request $request) {
        if ($request->filled('cid')) {
            $cid = $request->cid;    

            if ($cid == 'module') {
                $tplName = 'admin.partial_giftbag';    
            } else if ($cid == 'giftbaglist'){
                $tplName = 'admin.partial_giftbaglist';    
            }

            $bags = [];
            $kw = '';
            $kwtype = '';
            $bagTypes = self::$bagTypes;
            $userid = Auth::guard('admin')->id();

            $bags = GiftBagInfo::paginate(15);

            foreach ($bags as $bag) {
                $bag->type = self::$bagTypes[$bag->type];
                $bag->valid = self::$bagStatus[$bag->valid];    
            }

            return view($tplName,compact('bags', 'kw', 'kwtype', 'userid', 'bagTypes'));    
        }
    }
    public function creategiftbag (Request $request) {
        $data = $request->except(['_token']);
        $data['beginDate'] = date('Ymd', strtotime($data['beginDate']));
        $data['endDate'] = date('Ymd', strtotime($data['endDate']));
        $data['fun'] = 0;
        $data['number'] = (int)$data['number'];
        $data['type'] = (int)$data['type'];
        $data['count'] = (int)$data['count'];
        $data['reward'] = (double)$data['reward'];

        try {
            $result = json_decode($this->send_post(self::$giftbagApiUrl, $data));
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

    public function deletegiftbag (Request $request) {
        $data = $request->except (['_token']);
        $data['fun'] = 1;
       
        try {
            $result = json_decode($this->send_post(self::$giftbagApiUrl, $data));
            $result = $result ? $result->Response : (object)[];
        } catch (\Exception $e) {
            $result = (object)[
                'ret'   => 99,
                'msg'   => $e->getMessage(),
                'code'  => $e->getCode()
            ];
        }

        if ($result) {
            return response()->json($result);
        } else {    
            return response()->json([
                'ret'   => 1,
                'msg'   => 'api returned null'
            ]);    
        }
    }

    protected function send_post($url, $post_data) {
        //$data = http_build_query($post_data);
        $data = json_encode($post_data);
        $options = [
            'http'  => [
                'method'    => 'POST',
                //'header'    => 'Content-type:application/x-www-form-urlencoded',
                'header'    => "Content-type: application/json",
                'content'   => $data,
                'timeout'   => 10
            ]
        ];    

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        return $result;
    }
}
