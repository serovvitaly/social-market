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
        sleep(2);
        
        $input = Input::all();
         
        $rules = array(
            'email'          => 'required|email|unique:users',
            'password'       => 'required|min:6',
            'password_conf'  => 'same:password',
        );
        
        $messages = array(
            'required' => 'Поле :attribute и :other не может быть пустым.',
            'email'    => 'Email неверного формата',
            'min'      => 'Должно быть не меньше :min символов',
            'same'     => 'Поля "Пароль" и "Еще пароль" должны совпадать',
            'unique'   => 'Такой :attribute уже зарегистрирован'
        );
        
        $validation = Validator::make($input, $rules, $messages);
        
        $success = false;
        $result  = NULL; 
        
        if ($validation->fails())
        {
            $result = $validation->errors;
        }
        else {
            
            $user = new User;
            
            $user->email    = $input['email'];
            $user->password = Hash::make($input['email']);
            
            $user->save();
            
            $success = true;
            $result  = 'merchant-registration-ok';
        }
        
        
        return json_encode(array(
            'success' => $success,
            'result'  => $result
        ));
    }
    
    
    /**
    * Авторизация
    * 
    */
    public function action_login()
    {
        sleep(2);
        
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