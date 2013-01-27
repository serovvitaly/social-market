<?php


class Auth_Controller extends Base_Controller
{
    
    protected $_rules = array(
        'email'          => 'required|email',
        'password'       => 'required|min:6',
        'password_conf'  => 'same:password',
    );
                        
    protected $_messages = array(
        'required' => 'Поле :attribute и :other не может быть пустым.',
        'email'    => 'Email неверного формата',
        'min'      => 'Должно быть не меньше :min символов',
        'same'     => 'Поля "Пароль" и "Еще пароль" должны совпадать',
        'unique'   => 'Такой :attribute уже зарегистрирован'
    );
    
    /**
    * Форма
    * 
    */
    public function action_index()
    {
        //
        
        return View::make('aquincum/login');
    }
    
    
    /**
    * Регистрация
    * 
    */
    public function action_registration()
    {   
        sleep(2);
        
        $input = Input::all();
        
        $this->_rules['email'] = $this->_rules['email'] . '|unique:users';
        
        $validation = Validator::make($input, $this->_rules, $this->_messages);
        
        $success = false;
        $result  = NULL; 
        
        if ($validation->fails())
        {
            $result = $validation->errors;
        }
        else {
            
            $user = new User;
            
            $user->email    = $input['email'];
            $user->password = Hash::make($input['password']);
            
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
        
        $input = Input::all();
        
        $validation = Validator::make($input, $this->_rules, $this->_messages);
        
        $success = false;
        $result  = NULL; 
        
        if ($validation->fails())
        {
            $result = $validation->errors;
        }
        else {
            
            $credentials = array('username' => $input['email'], 'password' => $input['password']);

            if (Auth::attempt($credentials))
            {
                 $success = true;
                 $result  = 'login-ok';
            }
            else
            {
                $result = 'login-wrong';
            }
        }
        
        return json_encode(array(
            'success' => $success,
            'result'  => $result
        ));
    }
    
    
    /**
    * Разлогиневание
    * 
    */
    public function action_logout()
    {
        Auth::logout();
        return Redirect::to('/auth'); 
    }
}