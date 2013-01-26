<?php


class Merchant_Controller extends Private_Controller
{   
    protected $_data = array();
    
    protected function _layout($template)
    {
        $this->_data['user'] = Auth::user();
        
        return View::make($template, $this->_data);
    }
    
 
    public function action_index()
    {
        return $this->_layout('merchant.index');
    }
    
    
    public function action_apps_create()
    {
        return $this->_layout('merchant.apps.create');        
    }
    
    
    public function action_apps_list()
    {
        return $this->_layout('merchant.apps.list');        
    }
    
}