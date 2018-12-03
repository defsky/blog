<?php
namespace App\Facades;

use \Illuminate\Support\Facades\Facade;

class WebAPI extends Facade {
    public static function getFacadeAccessor () {
        return 'WebApiService';    
    }    
}
?>
