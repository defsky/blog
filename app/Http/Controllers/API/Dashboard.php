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
        $alive = Redis::get('dashboard:ac:alive');

        return response()->json([
            'celsius' => $t,
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
        // reserve last 120 records
        Redis::ltrim('dashboard:ac:history',0,360);

        $datas = [];

        $data = Redis::lrange('dashboard:ac:history',0,360);
        
        foreach($data as $v){
            array_unshift($datas,['celsius'=>$v,'alive'=>1]);
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
        
        $data = [
            'paodan'=>$paodanStatus
        ];

        return response()->json($data);
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
