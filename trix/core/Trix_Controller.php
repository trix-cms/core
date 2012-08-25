<?php

class Trix_Controller extends MX_Controller
{
    public $is_backend = FALSE;
    
    function __construct()
    {
        parent::__construct();
        
        // current module, controller and action
        CI::$APP->module = $this->router->fetch_module();
        CI::$APP->controller = $this->router->fetch_controller();
        CI::$APP->action = $this->router->fetch_action();
        CI::$APP->is_backend = $this->is_backend;
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
}