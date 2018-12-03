<?php
namespace App\Contracts;

interface WebApiContract
{
    public function post($data, $url);
    public function get($url, $header);    
}
