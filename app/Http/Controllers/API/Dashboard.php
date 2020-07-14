<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class Dashboard extends Controller
{
    /**
     * Get temperature data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getac()
    {
        $t = Redis::get('dashboard:ac:temperature');
        $avgt = Redis::get('dashboard:ac:avg');
        $alive = Redis::get('dashboard:ac:alive');

        return response()->json([
            'real' => $t,
            'avg' => $avgt,
            'alive' => $alive
        ]);
    }

    /**
     * Get recent temperature data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getachist()
    {
        $datas = [];

        $data = Redis::lrange('dashboard:ac:history',0,359);
        $avgdata = Redis::lrange('dashboard:ac:history:avg',0,359);

        foreach($data as $v) {
            array_push($datas,['real'=>$v,'avg'=>0,'alive'=>1]);
        }

        $idx = 0;
        foreach($avgdata as $avgv) {
            $datas[$idx++]['avg'] = $avgv;
        }

        return response()->json($datas);
    }

    /**
     * Get recent temperature data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getstatus()
    {
        // reserve last 120 records
        $paodanStatus = Redis::get('dashboard:erp:store:u9daemon:alive');
        $qlen = Redis::get('dashboard:erp:store:u9daemon:qlen');
        
        $data = [
            'paodan'=>$paodanStatus,
            'qlen' => $qlen
        ];

        return response()->json($data);
    }

    /**
     * Get recent bad doc data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getbaddoc()
    {
        // reserve last 120 records
        $baddoc = Redis::get('dashboard:baddoc');

        return response($baddoc, 200)
                  ->header('Content-Type', 'application/json');
    }

    /**
     * Get recent bad doc data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getvalue(Request $request)
    {
        $keyname = $request["key"];
        $data = Redis::get($keyname);

        return response($data, 200)
                  ->header('Content-Type', 'application/json');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
