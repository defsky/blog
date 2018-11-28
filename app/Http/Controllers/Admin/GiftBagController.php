<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\GiftBagInfo;

class GiftBagController extends Controller
{
    //
    protected $createGiftbagUrl = 'http://60.255.50.136:6880/create_giftcode.php';

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
    public function createGiftBag (Request $request) {
        $data = $request->except(['_token']);
        $data['fun'] = 0;
return $data;

        $result = json_decode($this->send_post($this->createGiftbagUrl, $data));

        return Response()->json([
            'ret'       => $result->ret,
            'msg'       => $result->msg
        ]);
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
        $result = file_get_contexts($url, false, $context);

        return $result;
    }
}
