<?php

class Modules_Controller extends Controllers\Backend {
    
    private $addons_url = 'http://trix/addons/get';
    
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('modules/modules_m');
        
        // хлебные крошки
        $this->breadcrumbs->add_item('Модули', 'admin/modules');
        
        // вложенный шаблон
        $this->template->set_layout('layout');
    }
    
    /**
     * Поиск дополнительных модулей
     */
    function action_search()
    {
        if( $this->is_ajax() )
        {
            if($this->get_http_response_code($this->addons_url) == '200')
            {
                echo @file_get_contents($this->addons_url);
            }
            else
            {
                echo 'Удаленный сервер не доступен';
            }
        }
        else
        {
            $this->render('search');
        }        
    }
    
    /**
     * Список модулей
     */
    function action_index()
    {
        $modules = $this->modules_m->where('is_core', 0)->get_all();
        $core_modules = $this->modules_m->where('is_core', 1)->get_all();
        
        $this->render('index', array(
            'modules'=>$modules,
            'core_modules'=>$core_modules
        ));
    }
    
    function get_http_response_code($url) 
    {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
    }
}