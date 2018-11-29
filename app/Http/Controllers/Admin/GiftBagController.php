<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\GiftBagInfo;

class GiftBagController extends Controller
{
    //
    protected $createGiftbagUrl = 'http://localhost:6880/create_giftcode.php';

    protected $bagTypes = [
        'Activity Coin',
        'Original Coin',
        'Activity Value'
    ];
    protected $bagStatus = [
        1 => 'Yes',
        0 => 'No'
    ];

    public function index (Request $request) {
        $bags = [];
        $kw = '';
        $kwtype = '';
        $bagTypes = $this->bagTypes;
        $userid = Auth::guard('admin')->id();

        $bags = GiftBagInfo::all();

        foreach ($bags as $bag) {
            $bag->type = $this->bagTypes[$bag->type];
            $bag->valid = $this->bagStatus[$bag->valid];    
        }

        return view('admin.partial_giftbag',compact('bags', 'kw', 'kwtype', 'userid', 'bagTypes'));    
    }
    public function creategiftbag (Request $request) {
        $data = $request->except(['_token']);
        $data['beginDate'] = date('Ymd', strtotime($data['beginDate']));
        $data['endDate'] = date('Ymd', strtotime($data['endDate']));
        $data['fun'] = 0;

        try {
            $result = json_decode($this->send_post($this->createGiftbagUrl, $data));
        } catch (\Exception $e) {
            $result = (object)[
                'ret'   => 1,
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
            $result = json_decode($this->send_post($this->createGiftbagUrl, $data));
        } catch (\Exception $e) {
            $result = (object)[
                'ret'   => 1,
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
        $data = http_build_query($post_data);
        $options = [
            'http'  => [
                'method'    => 'POST',
                'header'    => 'Content-type:application/x-www-form-urlencoded',
                'content'   => $data,
                'timeout'   => 15 * 60
            ]
        ];    

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        return $result;
    }
}
