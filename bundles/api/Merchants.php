<?php

namespace Api;

class Merchants
{
    public function hello($page = 5){return 'page6666-'.$page;}
    
    
    public function apps_get($id)
    {
        $app = \Laravel\Auth::user()->apps()->find($id);
        
        return array(
            'id'         => $app->id,
            'app_id'     => $app->app_id,
            'app_name'   => $app->app_name,
            'app_secret' => $app->app_secret,
        );
    }
    
}