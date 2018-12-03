<?php
namespace App\Services;

use App\Contracts\WebApiContract;

class WebApiService implements WebApiContract
{
    public function post($data, $url) {
        //$data = http_build_query($post_data);
        $post_data = json_encode($data);
        $options = [
            'http'  => [
                'method'    => 'POST',
                //'header'    => 'Content-type:application/x-www-form-urlencoded',
                'header'    => "Content-type: application/json",
                'content'   => $post_data,
                'timeout'   => 10
            ]
        ];    

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        return json_decode($result);
    }
    
    public function get($url, $header = []) {
        throw new \Exception('function need to be defined');    
    }    
}
