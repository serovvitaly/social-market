<?php


class Merchant_Controller extends Private_Controller
{
    
    public function action_index()
    {
        return View::make('merchant.index');
    }
    
    
    public function action_apps_create()
    {
        return View::make('merchant.apps.create');        
    }
    
    
    public function action_apps_list()
    {
        return View::make('merchant.apps.list');        
    }
    
}