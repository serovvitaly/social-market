<?php


class Auth_Controller extends Base_Controller
{
    
    /**
    * Форма
    * 
    */
    public function action_index()
    {
        //
        
        return View::make('merchant/_login');
    }
    
    
    /**
    * Регистрация
    * 
    */
    public function action_registration()
    {
        sleep(1);
        
        return json_encode(array(
            'success' => true,
            'result'  => 'merchant-registration-ok'
        ));
    }
    
    
    /**
    * Авторизация
    * 
    */
    public function action_login()
    {
        sleep(1);
        
        return json_encode(array(
            'success' => true,
            'result'  => 'merchant-authorization-ok'
        ));
    }
    
    
    /**
    * Разлогиневание
    * 
    */
    public function action_logout()
    {
        // 
    }
}