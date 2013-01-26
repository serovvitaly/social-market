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
    
    
    public function products_load($page = 1)
    {
        $output = array();
        
        $products = \Laravel\Auth::user()->products()->take(20)->get();
        
        if (count($products) > 0) {
            foreach ($products AS $product) {
                $output[] = array(
                    'id'          => $product->id,
                    'name'        => $product->name,
                    'price'       => number_format($product->base_price, 2),
                    'vendor'      => $product->vendor,
                    'picture'     => $product->picture,
                    'description' => $product->description,
                );
            }
        }
        
        return $output;
    }
    
}