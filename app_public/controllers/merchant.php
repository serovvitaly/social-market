<?php


class Merchant_Controller extends Private_Controller
{   
    protected $_data = array();
    
    protected $_rules = array(
        'app_id'     => 'required|numeric|unique:applications',
        'app_secret' => 'required|min:6',
    );
                        
    protected $_messages = array(
        'required' => 'Поле :attribute и :other не может быть пустым.',
        'numeric'  => 'Допускается только числовое значение',
        'min'      => 'Должно быть не меньше :min символов',
    );
    
    
    protected $_controller = NULL;
    
    protected $_action     = NULL;
    
    
    protected $_pages = array(
        'index' => array(
            'title' => 'Главная',
            'href'  => '/',
            'icon'  => 'dashboard.png'
        ),
        'apps' => array(
            'title' => 'Приложения',
            'href'  => '/apps',
            'icon'  => 'tables.png'
        ),
        'shops' => array(
            'title' => 'Магазины',
            'href'  => '/products',
            'icon'  => 'forms.png'
        ),
        'products' => array(
            'title' => 'Товары',
            'href'  => '/products',
            'icon'  => 'forms.png'
        ),
        'buyers' => array(
            'title' => 'Покупатели',
            'href'  => '/products',
            'icon'  => 'ui.png'
        )
    );
    
    
    public function before()
    {        
        $this->_controller = substr(Request::route()->controller, 9);
        
        $this->_action     = Request::route()->controller_action;
        
        
        $this->_data['user'] = Auth::user();
        
        $this->_data['applications'] = Auth::user()->apps()->get();
        
        $this->_data['current_page'] = NULL;
        
        if (isset($this->_pages[$this->_controller])) {
            $this->_pages[$this->_controller]['is_active'] = true;
            
            $this->_data['current_page'] = $this->_pages[$this->_controller];
        }
        
        $this->_data['pages_collection'] = $this->_pages;
    }
    
    
    public function after($response)
    {        
        $template = 'aquincum.' . $this->_controller . '.' . $this->_action;
        
        $response->content = View::make($template, $this->_data);
    }    
    
    
    public function action_application_add()
    {
        sleep(2);
        
        $input = Input::all();
        
        $id = (isset($input['id']) AND $input['id'] > 0) ? $input['id'] : NULL;
        
        if ($id) {
            $this->_rules['app_id'] = 'required|numeric';
        }
        
        $validation = Validator::make($input, $this->_rules, $this->_messages);
        
        $success = false;
        $result  = NULL; 
        $data    = NULL; 
        
        if ($validation->fails())
        {
            $result = $validation->errors;
        }
        else {
            
            if ($id) {
                $application = Auth::user()->apps()->find($input['id']);
                unset($input['id']);
                $application->fill($input);
                $application->save();
            }
            else {
                $application = new Application($input); 
                Auth::user()->apps()->insert($application);    
            }
            
            $data = array(
                'id'   => $application->id,
                'name' => $application->app_name,
            );
            
            $success = true;
            $result  = 'applicarion-adding-ok';
        }
        
        
        return json_encode(array(
            'success' => $success,
            'result'  => $result,
            'app'     => $data
        ));
    }
    
}