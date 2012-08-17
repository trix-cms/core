<?php

namespace Core\Controllers;

use CI;

class Base extends \MX_Controller
{
    
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
        
        $this->load->database();
                
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
    function render($view, $data = array())
    {
        $this->template->render($view, $data);
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