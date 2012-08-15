<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {
    
    public $is_backend = FALSE;
    protected $clink = '';
    
    function __construct()
    {
        parent::__construct();
        
        // current module, controller and action
        CI::$APP->module = $this->router->fetch_module();
        CI::$APP->controller = $this->router->fetch_controller();
        CI::$APP->action = $this->router->fetch_action();
        
        CI::$APP->is_backend = $this->is_backend;
        
        // домен
        CI::$APP->domen = str_replace('.tour-manager.ru', '', $_SERVER['HTTP_HOST']);
        
        // аккаунты
        $accounts = array(
            'demo'=>'FJcebmZB',
            'affrika'=>'boGbw41M'
        );
        
        
        // проверяем, существует ли аккаунт
        if( !key_exists(CI::$APP->domen, $accounts) AND $_SERVER['REMOTE_ADDR'] != '127.0.0.1' )
        {
            header("HTTP/1.0 404 Not Found");
            exit;
        }
        
        if( $_SERVER['REMOTE_ADDR'] != '127.0.0.1' )
        {
            // загружаем бд
            $config['hostname'] = 'localhost';
            $config['username'] = CI::$APP->domen;
            $config['password'] = $accounts[CI::$APP->domen];
            $config['database'] = CI::$APP->domen;
            $config['dbdriver'] = 'mysql';
            $config['dbprefix'] = '';
            $config['pconnect'] = TRUE;
            $config['db_debug'] = TRUE;
            $config['cache_on'] = FALSE;
            $config['cachedir'] = APPPATH . 'cache';
            $config['char_set'] = 'utf8';
            $config['dbcollat'] = 'utf8_general_ci';
            $config['swap_pre'] = '';
            $config['autoinit'] = TRUE;
            $config['stricton'] = FALSE;
            
            $this->load->database($config);
        }
        else
        {
            $this->load->database();
        }
        
        // загружаем необходимые библиотеки
        $this->load->library(array(
            'settings/settings',
            'user_agent', 
            'session', 
            'users/auth', 
            'template', 
            'permissions/permissions',
            'notification',
            'breadcrumbs'
        ));
        
        $this->load->library('seo', array(
            'add_method'=>'prepend'
        ));
        
        // заголовок
        $this->seo->add_title($this->settings->site_name);
        
        //$this->output->enable_profiler(TRUE);
    }
    
    /**
     * Сокращение для Template::render()
     */
    function render($view, $data = array(), $module = false)
    {
        $this->template->render($view, $data, $module);
    }
    
    /**
     * Сокращение для проверки типа запроса
     */
    function is_ajax()
    {
        return $this->input->is_ajax_request();
    }
    
    /**
     * Сокращение для Notification::set()
     */
    function set_message($type, $message)
    {
        $this->notification->set($type, $message);
    }
}